<?php
namespace App\Controllers;

use App\Helpers\Router;
use App\Helpers\Request;
use App\Controllers\Controller;

class ExceptionController extends Controller
{
    function __construct() {
        parent::__construct();
    }

    /**
     * Return error pages
     * 
     * @return ViewFile
     */
    public function errorPage($code)
    {
        return include($this->BASE_PATH."/views/errors/$code.php");
    }

    /**
     * SQL exception route
     */
    public function sqlErrorPage()
    {
        $data = Request::getData();
        return include($this->BASE_PATH.'/views/errors/sql.php');
    }

    /**
     * Boot exception routes
     */
    public static function bootExceptionRoute()
    {
        // not found
        Router::get('/error/:code', [self::class, 'errorPage']);

        // sql error route
        Router::get('/error/sql', [self::class, 'sqlErrorPage']);
    }
}