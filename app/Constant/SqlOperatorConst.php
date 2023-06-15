<?php

namespace App\Constant;

class SqlOperatorConst {

    // operator constants
    public static $OPT_EQUALS = '=';
    public static $OPT_LIKE = 'like';
    public static $OPT_NOT_EQUAL = '<>';
    public static $OPT_GREATER_THAN = '>';
    public static $OPT_LESS_THAN = '<';

    /**
     * Validate operator exists
     */
    public static function validateOperation(string $operator) : bool {
        $opt_list = [
            self::$OPT_EQUALS,
            self::$OPT_GREATER_THAN,
            self::$OPT_LESS_THAN,
            self::$OPT_LIKE,
            self::$OPT_NOT_EQUAL,
        ];
        
        return in_array($operator, $opt_list);
    }
}