<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\View;
use App\Helpers\Router;
use App\Helpers\Request;
use App\Models\ExpenseType;


class SettingsController extends Controller
{
    /**
     * Create a new AppController instance
     * 
     * @return void
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Return settings page
     * 
     * @return ViewFile
     */
    public function index()
    {
        $expense_types = ExpenseType::all();
        return new View($this->BASE_PATH . "/views/pages/settings.php", compact('expense_types'));
    }

    /**
     * Create new Expense type
     * 
     * @return redirection 
     */

    function addExpenseType()
    {
        $data = Request::getData();

        ExpenseType::create($data);

        return Router::redirect('settings.index');
    }

    /**
     * Delete one expense depending on id provided
     * 
     * @return redirection
     */
    function destroy() {
        $data = Request::getData();
        $type = ExpenseType::find($data['id']);

        try {
            $type->destroy();
        } catch (\Exception $e) {
            $_SESSION['error'] = "Something went wrong!";
        }

        return Router::redirect('settings.index');
    }
}
