<?php
namespace App\Traits;

use App\Helpers\Paginate;
use App\Helpers\Sanitizer;
use App\Constant\SqlOperatorConst;
use DateTime;
use Exception;
use PDO;

trait HasBuilder {
    /**
     * static function calls
     */
    public static function __callStatic($method, $args)
    {
        global $table;
        global $class;

        $m = strtolower($method);
        $table = self::getTableNameFromClassName();
        
        $namespaced_model = get_called_class();
        $class = new $namespaced_model();

        $builder = null;

        switch ($m) {
            case 'where':
                $builder = (new self())->where($args);
                break;
            case 'get':
                $builder = (new self())->get($args);
                break;
            case 'first':
                $builder = (new self())->first();
                break;
            case 'take':
                $builder = (new self())->take($args);
                break;
            case 'count':
                $builder = (new self())->count();
                break;
            case 'paginate':
                $builder = (new self())->paginate($args);
                break;
        }

        return $builder;
    }

    /**
     * non static function calls
     */
    public function __call($method, $args)
    {
        global $table;
        global $class;

        $class = $this;

        $m = strtolower($method);
        $table = self::getTableNameFromClassName();
        
        $builder = null;

        switch ($m) {
            case 'where':
                $builder = $this->where($args);
                break;
            case 'get':
                $builder = $this->get($args);
                break;
            case 'first':
                $builder = $this->first();
                break;
            case 'take':
                $builder = $this->take($args);
                break;
            case 'count':
                $builder = $this->count();
                break;
            case 'paginate':
                $builder = $this->paginate($args);
                break;
        }

        return $builder;
    }

    /**
     * Where sql function
     */
    private function where($args)
    {
        $opt = SqlOperatorConst::$OPT_EQUALS;
        $field = '';
        $value = '';

        // validate args
        if (!count($args) || count($args) < 2) {
            throw new Exception('Invalid arguments! Please state this arguments ($field, $operator, $value)');
        } elseif (count($args) == 2) {
            $field = $args[0];
            $value = $args[1];
        } else {
            $field = $args[0];
            $opt = $args[1];
            $value = $args[2];
        }


        global $table;
        global $class;
        $query = $class->query;
        if (!strstr($this->query, $table)) {
            $query = $query . $table;
        }
        
        if (!strstr(strtoupper($query), 'WHERE')) {
            // $query = $query . " WHERE $field $opt '$value'";
            $query = $this->appendParams($query . " WHERE `$field` $opt ", $value);
        } else {
            // $query = $query . " AND $field $opt '$value'";
            $query = $this->appendParams($query . " AND `$field` $opt ", $value);
        }

        $class->query = $query;

        return $class;
    }

    /**
     * Get sql function
     */
    private function get()
    {
        global $table;
        global $class;

        if (!strstr($this->query, $table)) {
            $this->query = $this->query . $table;
        }

        $stmt    = self::getConnection()->query($this->query);
        $results = $stmt->fetchAll();

        $data = [];
        foreach ($results as $dt) {
            // revert charactes
            $dt = Sanitizer::revertChars($dt);
            // create model called instance
            $class->setAttributes($dt);
            array_push($data, $class);
        }
        
        return $data;
    }

    private function first() {
        global $table;
        global $class;

        if (!strstr($class->query, $table)) {
            $class->query = $class->query . $table;
        }

        $stmt   = self::getConnection()->query($class->query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $class->setAttributes($result);
        }
        
        return $result ? $class : false;
    }

    /**
     * Get paginated data
     * 
     * @param Int $paginate_by
     * @param Int $offset
     * 
     * @return Paginate
     */
    private function paginate($args)
    {
        // error handlings
        if (!count($args) || count($args) < 1) {
            throw new Exception("paginate(): Has one required parameter.");
            return;
        }

        $paginate_by = $args[0];

        if (!$paginate_by && !is_int($paginate_by)) {
            throw new Exception("paginate(): Invalid value!");
            return;
        }

        $count = $this->count();
        $paginated = new Paginate([], $args[0], $count);

        $offset = ($paginated->current_page - 1) * $paginate_by;
        $taked  = $this->take([$paginate_by, $offset]);

        $paginated->items = $taked;
        
        return $paginated;
    }

    /**
     * Get limited data based on the parameter take
     * 
     * @param Int $take
     * @param Int $offset
     * 
     * @param Int $take
     * 
     * @return Model[] $results
     */
    private function take($args)
    {
        global $class;
        global $table;
        
        if (!count($args) || count($args) < 1) {
            throw new Exception('Invalid arguments! Please state this arguments ($limit, $offset) Take Note: $limit is required!');
        } else {
            $limit = $args[0];
            $offset = isset($args[1]) ? ($args[1] ? $args[1] : 0) : 0;
        }   

        $query = $class->query;
        if (!strstr($class->query, $table)) {
            $query = $query . $table;
        }

        $pre_query = "";
        if ($limit && $offset) {
            $pre_query = $query . " LIMIT $offset, $limit";
        } else if ($limit) {
            $pre_query = $query . " LIMIT $limit";
        }

        $class->query = $pre_query;

        $stmt = self::getConnection()->query($class->query);
        $results = $stmt->fetchAll();

        $data = [];
        foreach ($results as $dt) {
            $model = new $class();
            // revert charactes
            $dt = Sanitizer::revertChars($dt);
            // create model called instance
            $model->setAttributes($dt);
            array_push($data, $model);
        }
        
        return $data;
    }

    /**
     * Get the count of the elements 
     * 
     * @return Int $count of the elements
     */
    private function count()
    {
        global $class;
        global $table;

        // check errors
        $query = $class->query;
        if (!strstr($class->query, $table)) {
            $query = $query . $table;
        }

        if (strpos($query, 'SELECT') === false) {
            throw new Exception('count() is only available for SELECT statements');
            return;
        }

        $start = strpos($query, 'SELECT') + strlen('SELECT') + 1;
        
        $query = substr_replace($query, "COUNT(*)", $start, 1);

        $stmt = self::getConnection()->query($query);
        return $stmt->fetch()[0];
    }


    /************************************
     * 
     * HELPER FUNCTIONS
     * 
     ***********************************/

    //TODO: For inhancement: Don't use implicit typing in query.
    
    /**
     * Append additional query conditions
     * 
     * @param $sql_keyword SQL keywords
     * @param $value Parameter value for some conditions
     * 
     * @return String 
     */
    private function appendParams($sql_keyword, $value)
    {
        // check value type
        switch (gettype($value)) {
            case 'object':
                if ($value instanceof DateTime) {
                    $value = $value->format("Y-m-d");
                    $value = "DATE('$value')";
                }
                break;
            default:
                $value = "'$value'";
                break;
        }

        return $sql_keyword . $value;
    }
}
