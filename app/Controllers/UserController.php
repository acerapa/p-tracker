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
        $route = '/user/list';
        echo "<script>window.location.href='$route'</script>";
        // Router::redirect('auth.loginpage'); // temporary
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
        $data = Request::getData();
        $user->update($data);
        $route = '/user/list';
        echo "<script>window.location.href='$route'</script>";
        // Router::redirect('user.list'); // temporary
    }
}
