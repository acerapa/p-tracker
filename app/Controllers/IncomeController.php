<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Helpers\Request;
use App\Helpers\Router;
use App\Models\Income;
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
        return new View($this->BASE_PATH."/views/pages/income.php");
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

        $data['user_id'] = $user->id;
        $data['when']    = date_create($data['when'])->format("Y-m-d");

        Income::create($data);
    }

    /**
     * Delete Income
     */
    public function destroy(Income $income)
    {
        $income->destroy();
    }


}