<?php
namespace App\Controllers;

use App\Models\User;

class UserController {
    public function store()
    {
        $data = [
            'username' => 'harapa12',
            'email' => 'harapa@email.com',
            'password' => 'password',
            'user_role' => 1
        ];

        User::create($data);
    }
}