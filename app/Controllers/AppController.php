<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Request;
use App\Helpers\View;

class AppController extends Controller
{
    /**
     * Create a new AppController instance
     * 
     * @return void
     */
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
        $route = Request::$route;
        return new View($this->BASE_PATH."/views/index.php", compact('route'));
    }

    /**
     * Return activity page
     * 
     * @return ViewFile
     */
    public function activity()
    {
        return new View($this->BASE_PATH."/views/pages/activity.php");
    }

    /**
     * Return dashboard page
     * 
     * @return ViewFile
     */
    public function dashboard()
    {
        return new View($this->BASE_PATH."/views/pages/dashboard.php");
    }

    /**
     * Return my calendar page
     * 
     * @return ViewFile
     */
    public function myCalendar()
    {
        return new View($this->BASE_PATH."/views/pages/my-calendar.php");
    }

    /**
     * Return todolist page
     * 
     * @return ViewFile
     */
    public function todoList()
    {
        return new View($this->BASE_PATH."/views/pages/todolist.php");
    }

    /**
     * Return notes page
     * 
     * @return ViewFile
     */
    public function notes()
    {
        return new View($this->BASE_PATH."/views/pages/notes.php");
    }
}
