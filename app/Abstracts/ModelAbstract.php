<?php
namespace App\Abstracts;

abstract class ModelAbstract {
    
    // query
    protected $query = 'SELECT * FROM ';
    
    // fillables
    protected static $fields = [];
    
    // table name
    protected static $table = "";

    // attributes
    protected $attributes = [];

    // set attributes
    abstract public function setAttributes($data);

    // get attributes
    abstract public function getAttributes();
}
