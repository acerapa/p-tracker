<?php
namespace App\Controllers;

use App\Models\User;
use App\Helpers\Router;
use App\Helpers\Request;
use App\Helpers\Sanitizer;
use App\Controllers\Controller;
use App\Constant\SqlOperatorConst;
use App\Helpers\View;

class UserController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    public function store()
    {
        $data = Sanitizer::sanitize(Request::getData());

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
        return new View($this->BASE_PATH."/views/user/list.php", compact('users'));
    }

    public function edit(User $user)
    {
        return new View($this->BASE_PATH."/views/user/edit.php", compact('user'));
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

    public function updateProfile()
    {
        $user = $_SESSION['auth'];
        $data = Sanitizer::sanitize(Request::getData());
        $user->update($data);
        Router::redirect('user.edit', [$user->id]);
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
