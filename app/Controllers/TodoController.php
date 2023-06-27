<?php
namespace App\Controllers;

use App\Controllers\Controller;

class TodoController extends Controller {
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
        return include($this->BASE_PATH."/views/todo/index.php");
    }
}