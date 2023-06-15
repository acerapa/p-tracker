<?php
namespace App\Controllers;

use App\Models\User;
use App\Helpers\Router;
use App\Helpers\Request;
use App\Helpers\Sanitizer;
use App\Controllers\Controller;

class UserController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    public function store()
    {
        $data = Sanitizer::sanitize(Request::getData());
        // $data = Request::getData();

        // hash password
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $user = User::create($data);
        Router::redirect('user.list');
    }

    public function list()
    {
        $users = User::all();
        return include($this->BASE_PATH."/views/user/list.php");
    }

    public function edit(User $user)
    {
        return include($this->BASE_PATH."/views/user/edit.php");
    }

    public function update(User $user)
    {   
        $data = Sanitizer::sanitize(Request::getData());
        $user->update($data);
        Router::redirect('user.list');
    }

    public function destroy(User $user)
    {
        $user->destroy();
        Router::redirect('user.list');
    }

    /**=================================
     * APIs
     ===================================*/
    public function userList()
    {
        header('Content-Type: application/json');
        $users = User::all();
        echo json_encode($users);
    }
}
