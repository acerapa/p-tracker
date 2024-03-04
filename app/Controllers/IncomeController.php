<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Request;
use App\Helpers\View;

class IncomeController extends Controller
{
    /**
     * Create a new IncomeController instance
     * 
     * @return void
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Return the Income Page
     * 
     * @return ViewFile
     */
    public function index()
    {
        return new View($this->BASE_PATH."/views/pages/income.php");;
    }
}