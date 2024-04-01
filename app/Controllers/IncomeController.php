<?php
namespace App\Controllers;

use App\Constant\SqlOperatorConst;
use App\Controllers\Controller;
use App\Helpers\Request;
use App\Helpers\Router;
use App\Models\CashFlow;
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
        $search_params = Request::getData();
        $builder = CashFlow::where('is_income', SqlOperatorConst::$OPT_EQUALS, true);
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

        $incomes = $builder->paginate(10);


        return new View($this->BASE_PATH."/views/pages/income.php", compact('incomes', 'search_params'));
    }

    /**
     * Create new Income
     * 
     * @return string $message
     */
    public function create()
    {
        $data = Request::getData();
        $user = $_SESSION['auth'];

        $data['is_income'] = true;
        $data['user_id']   = $user->id;
        $data['when']      = date_create($data['when'])->format("Y-m-d");

        CashFlow::create($data);
        return Router::redirect('income.index');
    }

    /**
     * Delete Income
     */
    public function destroy()
    {
        $data = Request::getData();
        $income = CashFlow::find($data['id']);
        
        try {
            $income->destroy();
        } catch (\Exception $e) {
            $_SESSION['error'] = "Something went wrong!";
        }

        Router::redirect('income.index');
    }
}