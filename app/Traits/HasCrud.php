<?php
namespace App\Traits;

use PDO;
use App\Helpers\Sanitizer;
use App\Helpers\Paginate;

trait HasCrud {
    /**===========================================
     * IMPLEMENTS
     ============================================*/

    /**
     * Insert a new element in the database
     * 
     * @param Array $data
     */
    public static function create($data)
    {
        $data = self::cleanFields($data);
        $query = self::createQueryString('INSERT', $data);
        $stmt = self::getConnection()->prepare($query);
        $stmt->execute($data);

        // create model called instance
        $class = get_called_class();
        $model = new $class();
        $model->setAttributes($data);
        
        return $model;
    }

    /**
     * Get row by the given ID
     * 
     * @param mixed $id
     * 
     * @return Model
     */
    public static function find($id) {
        
        $query = self::createQueryString('WHERE', ['id']);
        $stmt  = self::getConnection()->prepare($query);
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // create model called instance
        $class = get_called_class();
        $model = new $class();
        
        if ($result) {
            $model->setAttributes($result);
        }

        return $model;
    }

    /**
     * Get all data
     * 
     * @return Model[]
     */
    public static function all()
    {
        $query   = self::createQueryString('SELECT');
        $stmt    = self::getConnection()->query($query);
        $results = $stmt->fetchAll();
        
        $data = [];
        foreach ($results as $dt) {
            // revert charactes
            $dt = Sanitizer::revertChars($dt);
            // create model called instance
            $class = get_called_class();
            $model = new $class();
            $model->setAttributes($dt);
            array_push($data, $model);
        }

        return $data;
    }

    /**
     * Get paginated data
     * 
     * @param Int $paginate_by
     * @param Int $offset
     * 
     * @return Paginate
     */
    public static function paginate($paginate_by)
    {
        $query  = self::createQueryString('COUNT');
        $stmt   = self::getConnection()->query($query);
        $count = $stmt->fetch()[0];

        $paginated = new Paginate([], $paginate_by, $count);
        
        $offset = ($paginated->current_page - 1) * $paginate_by;
        $taked  = self::take($paginate_by, $offset);

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
     */
    public static function take($take, $offset = 0)
    {
        $query   = self::createQueryString('SELECT');

         // modify the query
        if ($offset) {
            $query = str_replace(';', ' ', $query)."limit $offset, $take;";
        } else {
            $query   = str_replace(';', ' ', $query)."limit $take;";
        }

        $stmt    = self::getConnection()->query($query);
        $results = $stmt->fetchAll();

        $data = [];
        foreach ($results as $dt) {
            // revert charactes
            $dt = Sanitizer::revertChars($dt);
            // create model called instance
            $class = get_called_class();
            $model = new $class();
            $model->setAttributes($dt);
            array_push($data, $model);
        }

        return $data;
    }

    /**
     * Update data by ID
     * 
     * @param Array $data
     * 
     * @return Model
     */
    public function update($data)
    {
        $data  = self::cleanFields($data);
        $query = self::createQueryString('UPDATE', $data)." WHERE id = " . $this->id . ";";
        $stmt  = self::getConnection()->prepare($query);
        $stmt->execute($data);

        // create model called instance
        $class = get_called_class();
        $model = new $class();
        $model->setAttributes($data);
        
        return $model;
    }

    /**
     * Delete an element
     * 
     * @return boolean
     */
    public function destroy()
    {
        try {
            $table = self::$table ? self::$table : self::getTableNameFromClassName();
            $id    = $this->id;
            $query = "DELETE from $table WHERE id = $id;";
            $stmt  = self::getConnection()->prepare($query);
            $stmt->execute();

            return true; 
        } catch ( Exception $e ) {
            return false;
        }
    }

    /**
     * Set model attributes
     */
    public function setAttributes($data) {
        $dataSyncFields = self::cleanFields($data);
        $this->attributes = $dataSyncFields;
        foreach ($dataSyncFields as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Get model attributes
     */
    public function getAttributes() {
        return $this->attributes;
    }

    /**===========================================
     * HELPERS
     ============================================*/

    /**
     * Create query string depens on the type
     * 
     * @param String $type values can be (insert, update, delete, select)
     * @param Array  $data data to pass
     * 
     * @return String 
     */
    private static function createQueryString(String $type, Array $data = []) {
        $queryString = "";
        switch (strtoupper($type)) {
            case 'INSERT':
                $queryString = self::formatInsertQueryString($data);
                break;
            case 'UPDATE':
                $queryString = self::formatUpdateQueryString($data);
                break;
            case 'DELETE':
                break;
            case 'SELECT':
                $queryString = self::formatSelectQuerystring($data);
                break;
            case 'WHERE':
                $queryString = self::formatWhereQueryString($data);
                break;
            case 'COUNT':
                $queryString = self::formatCountQueryString($data);
                break;
        }
        return $queryString;
    }

    /**
     * Format where clause query string for fields only
     * 
     * @param Array $fields
     * 
     * @return String
     */
    public static function formatWhereQueryString($fields)
    {
        // temporary for now
        $table = self::$table ? self::$table : self::getTableNameFromClassName();
        $queryString = "SELECT * FROM `$table` WHERE ";
        foreach ($fields as $field) {
            $queryString.="$field = ?,";
        }

        return substr($queryString, 0, -1).";";
    }

    
    /**
     * Format insert query strings
     * 
     * @param Array $values
     * 
     * @return String
     */
    private static function formatInsertQueryString($data)
    {
        $table = self::$table ? self::$table : self::getTableNameFromClassName();   
        $queryString = "INSERT INTO `$table` ";
        $fields = array_intersect(self::getFields(), array_keys($data));

        // build query string
        $queryString = $queryString."(`".implode("`,`", $fields)."`) VALUES (:".implode(", :", $fields).");";

        return $queryString;
    }

    /**
     * Format select query string
     * 
     * @param Array $fields
     * 
     * @return String
     */
    public static function formatSelectQuerystring($fields = [])
    {
        $table = self::$table ? self::$table : self::getTableNameFromClassName(); 
        $queryString = "SELECT ";
        if (!count($fields)) {
            $queryString .= "* FROM $table;";
        }

        return $queryString;
    }

    /**
     * Format update query string
     * 
     * @param Array $data
     * 
     * @return String
     */
    public static function formatUpdateQueryString($data)
    {
        $table = self::$table ? self::$table : self::getTableNameFromClassName();
        $queryString = "UPDATE `$table` SET ";

        // build query string
        foreach ($data as $key => $value) {
            $queryString .= "$key = :$key,";
        }

        return substr($queryString, 0, -1);
    }


    /**
     * Format count query string
     * 
     * @param Array $data
     * 
     * @return String
     */
    public static function formatCountQueryString($data)
    {
        $table = self::$table ? self::$table : self::getTableNameFromClassName();
        $queryString = "SELECT COUNT(*) FROM $table;";

        return $queryString;
    }

    /**
     * Get fields declared in Model
     * 
     * @return Array
     */
    public static function getFields()
    {
        $fields = get_called_class()::$fields;
        array_push($fields, 'id');
        return $fields;
    }

    /**
     * Clean fields
     * 
     * @param Array $data 
     * 
     * @return Array
     */
    public static function cleanFields($data)
    {
        return array_filter(
            $data,
            function ($key) use ($data) {
                return in_array($key, self::getFields());
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}