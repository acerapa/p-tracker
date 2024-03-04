<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Request;
use App\Helpers\View;

class BudgetingController extends Controller
{
    /**
     * Create a new BudgetingController instance
     * 
     * @return void
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * Return the Budgeting Page
     * 
     * @return ViewFile
     */
    public function index()
    {
        return new View($this->BASE_PATH."/views/pages/budgeting.php");
    }
}