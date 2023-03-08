<?php
namespace App\Controllers;

class Controller
{
    protected $BASE_PATH;
    
    function __construct() {
        $this->BASE_PATH = dirname(__DIR__);
    }
}
