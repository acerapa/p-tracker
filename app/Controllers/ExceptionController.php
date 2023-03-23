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
     * Retrun 404 page
     * 
     * @return ViewFile
     */
    public function error404Page()
    {
        return include($this->BASE_PATH.'/views/errors/404.php');
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
        Router::get('/error/404', [self::class, 'error404Page']);

        // sql error route
        Router::get('/error/sql', [self::class, 'sqlErrorPage']);
    }
}