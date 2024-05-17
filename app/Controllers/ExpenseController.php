<?php

namespace App\Controllers;

use App\Constant\SqlOperatorConst;
use App\Controllers\Controller;
use App\Helpers\Request;
use App\Helpers\Router;
use App\Models\CashFlow;
use App\Models\ExpenseType;
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
        $search_params = Request::getData();
        $builder = CashFlow::where('is_income', SqlOperatorConst::$OPT_EQUALS, false);
        if (isset($search_params['amount'])) {
            if ($search_params['amount'] !== '') {
                $builder = $builder->where('amount', SqlOperatorConst::$OPT_EQUALS, $search_params['amount']);
            }
        } 

        if (isset($search_params['from'])) {
            if ($search_params['from']) {
                $builder = $builder->where('when', SqlOperatorConst::$OPT_GREATER_THAN_OR_EQUAL, date_create($search_params['from']));
            }
        }

        if (isset($search_params['to'])) {
            if ($search_params['to']) {
                $builder = $builder->where('when', SqlOperatorConst::$OPT_LESS_THAN_OR_EQUAL, date_create($search_params['to']));
            }
        }

        // get all expense types
        $expense_types = ExpenseType::all();

        $expenses = $builder->paginate(10);
        return new View($this->BASE_PATH . "/views/pages/expense.php", compact('search_params', 'expenses', 'expense_types'));
    }

    /**
     * Create new Expense
     * 
     * @return string $message
     */
    public function create()
    {
        $data = Request::getData();
        $user = $_SESSION['auth'];

        $data['is_income']  = false;
        $data['user_id']    = $user->id;
        $data['when']       = date_create($data['when'])->format("Y-m-d");

        CashFlow::create($data);
        return Router::redirect('expense.index');
    }

    /**
     * Delete Income
     */
    public function destroy()
    {
        $data = Request::getData();
        $expense = CashFlow::find($data['id']);
        
        try {
            $expense->destroy();
        } catch (\Exception $e) {
            $_SESSION['error'] = "Something went wrong!";
        }

        Router::redirect('expense.index');
    }
}
