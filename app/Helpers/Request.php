<?php
namespace App\Helpers;

class Request {
    /**
     * @var $attributes based from the $_SERVER varaible of php
     */
    protected static $attributes = [];

    /**
     * Fill $attributes with the values inside the $_SERVER
     */
    public static function setAttributes() {
        foreach ($_SERVER as $key => $value) {
            self::$attributes[strtolower($key)] = $value;
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
}