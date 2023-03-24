<?php
namespace App\Traits;

trait Crud {
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

    public static function select($fields = [])
    {
        # code ...
    }

    public static function all()
    {
        $query   = self::createQueryString('SELECT');
        $stmt    = self::getConnection()->query($query);
        $results = $stmt->fetchAll();
        
        $data = [];
        foreach ($results as $user) {
            // create model called instance
            $class = get_called_class();
            $model = new $class();
            $model->setAttributes($user);
            array_push($data, $model);
        }

        return $data;
    }

    public function update($data)
    {
        $data  = self::cleanFields($data);
        $query = self::createQueryString($data);
        $stmt  = self::getConnection()->prepare($query);
        $stmt->execute($data);

        // create model called instance
        $class = get_called_class();
        $model = new $class();
        $model->setAttributes($data);
        
        return $model;
}

    public function destroy()
    {
        # code...
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
                $queryString = self::formatSelectQuerystring();
                break;
        }
        return $queryString;
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
    public function formatUpdateQueryString($data)
    {
        $table = self::$table ? self::$table : self::getTableNameFromClassName();
        $queryString = "UPDATE `$table` SET ";

        // build query string
        foreach ($data as $key => $value) {
            $queryString .= "$key = :$key";
        }

        return $queryString.";";
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