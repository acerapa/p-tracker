<?php
namespace App\Controllers;

use App\Models\User;
use App\Controllers\Controller;

class UserController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    public function store()
    {
        $data = [
            'username' => 'harapa12',
            'email' => 'harapa@email.com',
            'password' => 'password',
            'user_role' => 1
        ];

        $user = User::create($data);
        var_dump($user->attributes);
    }
}