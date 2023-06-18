<?php
namespace App\Middleware\Define;

use App\Interfaces\IMiddleware;

class AuthMiddleware implements IMiddleware {
    public static function authorized()
    {
        return false;
    }

    public static function handle() {
        
    }
}