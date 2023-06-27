<?php
namespace App\Middleware\Define;

use App\Helpers\Router;
use App\Interfaces\IMiddleware;

class CsrfMiddleware implements IMiddleware {
    public static function authorized() : bool
    {
        return true;
    }

    public static function handle() : bool
    {
        if (isset($_POST['csrf_token'])) {
            if (hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
                return true;
            }
        }
        Router::redirect('exception.errorpage', [419]);
        return false;
    }
}