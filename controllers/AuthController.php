<?php

class AuthController {
    protected $BASE_PATH;
    function __construct() {
        $this->BASE_PATH = dirname(__DIR__);
    }

    /**
     * Return the login page
     * 
     * @return ViewFile
     */
    public function loginPage()
    {
        return include($this->BASE_PATH.'/views/auth/login.php');
    }
}