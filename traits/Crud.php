<?php
trait Crud {
    /**
     * Insert a new element in the database
     */
    public static function create()
    {
        var_dump(self::getTableNameFromClassName());
    }

    /**
     * Create query string depens on the type
     * 
     * @param String $type values can be (insert, update, delete, select)
     * 
     * @return String 
     */
    private function createQueryString(String $type) {
        $queryString = "";
        switch (strtoupper($type)) {
            case 'INSERT':
                break;
            case 'UPDATE':
                break;
            case 'DELETE':
                break;
            case 'SELECT':
                break;
        }
    }
    
    private function formatInsertQueryString()
    {
        # code...
    }
}