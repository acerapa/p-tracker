<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Request;
use App\Helpers\View;

class ExpenseController extends Controller
{
    /**
     * Create a new ExpenseController instance
     * 
     * @return void
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Return the Expense Page
     * 
     * @return ViewFile
     */
    public function index()
    {
        return new View($this->BASE_PATH . "/views/pages/income.php");;
    }
}
