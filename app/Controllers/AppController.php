<?php
namespace App\Controllers;

use App\Controllers\Controller;

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
        return include($this->BASE_PATH."/views/index.php");
    }

    /**
     * Return activity page
     * 
     * @return ViewFile
     */
    public function activity()
    {
        return include($this->BASE_PATH."/views/pages/activity.php");
    }
}
