<?php
namespace App\Controllers;

use App\Controllers\Controller;

class AppController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    /**
     * Return welcome page
     * 
     * @return ViewFile
     */
    public function index()
    {
        return include($this->BASE_PATH."/views/index.php");
    }
}
