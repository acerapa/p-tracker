<?php
namespace App\Controllers;

use App\Controllers\Controller;

class AuthController extends Controller
{
    function __construct() {
        parent::__construct();
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

    /**
     * Return register page
     * 
     * @return ViewFile 
     */
    public function registerPage()
    {
        return include($this->BASE_PATH.'/views/auth/register.php');
    }
}