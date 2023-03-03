<?php
namespace App\Traits;

trait Crud {
    /**
     * Insert a new element in the database
     */
    public static function create()
    {
        self::createQueryString('INSERT');
    }

    /**
     * Create query string depens on the type
     * 
     * @param String $type values can be (insert, update, delete, select)
     * 
     * @return String 
     */
    private static function createQueryString(String $type) {
        $queryString = "";
        switch (strtoupper($type)) {
            case 'INSERT':
                self::formatInsertQueryString([]);
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
    private static function formatInsertQueryString($values = [])
    {
        $table = self::$table || self::getTableNameFromClassName();   
        $queryString = "INSERT INTO `".self::$table."`";

        echo $queryString;
    }
}