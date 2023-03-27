<?php
namespace App\Controllers;

use App\Models\User;
use App\Helpers\Router;
use App\Helpers\Request;
use App\Controllers\Controller;

class UserController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    public function store()
    {
        $data = Request::getData();
        $user = User::create($data);
        Router::redirect('auth.loginpage');
    }

    public function list()
    {
        $users = User::all();
        return include($this->BASE_PATH."/views/user/list.php");
    }

    public function edit()
    {
        # code ...
    }

    public function update(User $user)
    {
        $data = [
            'first_name' => 'Harvey (updated)',
            'last_name'  => 'Aparece (updated)'
        ];

        $user->update($data);
    }
}
