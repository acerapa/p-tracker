<?php
namespace App\Helpers;

class Router {

    /**
     * @var Array array of registered routes
     */
    private static $routes = [];

    /**
     * @var Array array of allowed http methods
     */
    private static $methods = ['GET', 'POST', 'PUT', 'DELETE']; 

    /**
     * Calls this method when nothing is specified function name
     */
    public static function __callStatic($method, $args)
    {
        // testing route class
        $instance = new $args[1][0]();
        $func = $args[1][1];
        $instance->{$func}();
        // call_user_func([new $args[1][0]()], $args[1][1]);
    }

    /**
     * Resolves route   
     */
    public function run()
    {
        # code...
    }
}