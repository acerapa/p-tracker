<?php
namespace App\Helpers;

use Exception;

class Router {
    /**
     * @var String exception route
     */
    private static $route404 = '/error/404';

    /**
     * @var Array array of allowed http methods
     */
    private static $methods = ['GET', 'POST', 'PUT', 'DELETE']; 

    /**
     * Calls this method when nothing is specified function name
     */
    public static function __callStatic($method, $args)
    {
        if (in_array(strtoupper($method), self::$methods)) {
            $formattedRoute = [
                'method'   => strtoupper($method),
                'route'    => $args[0],
                'class'    => $args[1][0],
                'callback' => $args[1][1]
            ];

            // resolve routes
            self::resolve($formattedRoute);
        } else {
            throw new Exception("Method not supported: ".strtoupper($method));
        }
    }

    /**
     * Resolves route
     */
    private static function resolve($formattedRoute)
    {
        $route  = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if ($formattedRoute['method'] === $method && $formattedRoute['route'] === $route) {
            $instance = new $formattedRoute['class']();
            $instance->{$formattedRoute['callback']}();
            return;
        }

        // resolve not found route
        if ($formattedRoute['route'] === self::$route404) {
            $instance = new $formattedRoute['class']();
            $instance->{$formattedRoute['callback']}();
            return;
        }
    }
}
