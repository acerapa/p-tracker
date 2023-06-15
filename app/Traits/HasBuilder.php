<?php
namespace App\Traits;

use App\Helpers\Sanitizer;
use App\Constant\SqlOperatorConst;
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
            $query = $query . " WHERE $field $opt '$value'";
        } else {
            $query = $query . " AND $field $opt '$value'";
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

    function first() {
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
}
