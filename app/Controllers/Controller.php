<?php
namespace App\Controllers;

class Controller
{
    protected $BASE_PATH;
    
    function __construct() {
        $this->BASE_PATH = dirname(__DIR__);
        
        // start session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
}
