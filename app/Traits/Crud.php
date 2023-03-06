<?php
namespace App\Traits;

use App\Config\Database;

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
        $query = self::createQueryString('INSERT', $data);
        $stmt = Database::$conn->prepare($query);
        $stmt->execute($data);

        // create model called instance
        $class = get_called_class();
        $model = new $class();
        $model->setAttributes(self::getFields(), $data);
        
        return $model;
    }

    public static function select()
    {
        # code ...
    }

    public function update()
    {
        # code...
    }

    public function destroy()
    {
        # code...
    }

    /**
     * Set model attributes
     */
    public function setAttributes($fields, $data) {
        
    }

    /**
     * Get model attributes
     */
    public function getAttributes() {

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
                break;
            case 'DELETE':
                break;
            case 'SELECT':
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
     * Get fields declared in Model
     * 
     * @return Array
     */
    public static function getFields()
    {
        return get_called_class()::$fields;
    }
}