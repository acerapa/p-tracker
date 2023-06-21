<?php
namespace App\Middleware\Define;

use App\Helpers\Router;
use App\Interfaces\IMiddleware;

class AuthMiddleware implements IMiddleware {
    public static function authorized() : bool
    {
        return true;
    }

    public static function handle() : bool
    { 
        if (isset($_SESSION['auth']) && $_SESSION['auth']) {
            return true;
        }

        Router::redirect('auth.loginpage');
        return false;
    }   
}