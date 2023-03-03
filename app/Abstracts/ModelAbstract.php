<?php
namespace App\Abstracts;

abstract class ModelAbstract {
    
    // fillables
    protected static $fields = [];
    
    // table name
    protected static $table = "";

    // attributes
    protected static $attributes = [];

    // set attributes
    abstract public function setAttributes($fields, $data);

    // get attributes
    // set attributes
    abstract public function getAttributes();
}
