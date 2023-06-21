<?php
namespace App\Middleware\Define;

use App\Helpers\Router;
use App\Interfaces\IMiddleware;

class PageMiddleware implements IMiddleware {
    public static function authorized() : bool
    {
        return true;
    }

    public static function handle() : bool
    {
        if (!(isset($_SESSION['auth']) && $_SESSION['auth'])) {
            return true;
        }
        
        Router::redirect('app.index');
        return false;
    }
}