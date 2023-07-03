<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\View;

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
        return new View($this->BASE_PATH."/views/todo/index.php");
    }
}
