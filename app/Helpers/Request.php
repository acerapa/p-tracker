<?php
namespace App\Helpers;

class Request {
    /**
     * @var $attributes based from the $_SERVER varaible of php
     */
    protected static $attributes = [];

    /**
     * @var $DATA_VARS varaibles inside attributes with data_ prefixed key
     */
    private static $DATA_VARS = 'data_';

    /**
     * Fill $attributes with the values inside the $_SERVER
     */
    public static function setAttributes() {
        // for $_SERVER
        foreach ($_SERVER as $key => $value) {
            self::$attributes[strtolower($key)] = $value;
        }

        // for $_POST
        foreach($_POST as $key => $value) {
            self::$attributes["data_".strtolower($key)] = $value;
        }

        // for $_GET
        foreach($_GET as $key => $value) {
            self::$attributes["data_".strtolower($key)] = $value;
        }
    }

    /**
     * Get all attributes
     * 
     * @return Array $attributes
     */
    public static function getAttributes()
    {
        return self::$attributes;
    }

    /**
     * Get data passed from $_POST and $_GET from request
     * 
     * @return Array
     */
    public static function getData()
    {
        $data = array_filter(
            self::$attributes, function ($key)
            {
                return str_contains($key, self::$DATA_VARS);
            },
            ARRAY_FILTER_USE_KEY
        );

        $res = [];
        foreach ($data as $key => $value) {
            $res[substr($key, strlen(self::$DATA_VARS))] = $value;
        }

        return $res;
    }
}
