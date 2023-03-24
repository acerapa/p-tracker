<?php
namespace App\Helpers;

use Exception;
use App\Helpers\Request;

class Router {
    /**
     * @var array holds all routes
     */
    private static $routes = [];

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
     * 
     * @param String $method static function name
     * @param Array  $args arguments 
     */
    public static function __callStatic($method, $args)
    {
        if (in_array(strtoupper($method), self::$methods)) {
            $routeNameInitial = explode('\\', $args[1][0]);
            $formattedRoute = [
                'method'   => strtoupper($method),
                'route'    => self::extractRoute($args[0]),
                'class'    => $args[1][0],
                'callback' => $args[1][1],
                'name'     => str_replace('controller', '', strtolower(end($routeNameInitial).'.'.$args[1][1]))
            ];

            array_push(self::$routes, $formattedRoute);
        } else {
            throw new Exception("Method not supported: ".strtoupper($method));
        }
    }

    /**
     * Resolves route
     */
    public static function run()
    {
        $is_route_matched = false;
        $route  = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // set attributes
        Request::setAttributes();

        foreach (self::$routes as $formattedRoute) {
            if ($formattedRoute['method'] === $method && $formattedRoute['route'] === self::extractRoute($route)) {
                $is_route_matched = true;
                $instance = new $formattedRoute['class']();
                $instance->{$formattedRoute['callback']}();
                return;
            }
        }

        if (!$is_route_matched) {
            self::resolve404Page();
            return;
        }
    }

    /**
     * Resolves route not found 404
     */
    private static function resolve404Page()
    {
        $routes = array_column(self::$routes, 'route');
        $routeIndex = array_search(self::$route404, $routes);
        $formattedRoute = self::$routes[$routeIndex];
        $instance = new $formattedRoute['class']();
        $instance->{$formattedRoute['callback']}();
    }

    /**
     * Extract route path and route params
     * 
     * @param String  $route path router
     * 
     * @return String $path route path
     */
    private static function extractRoute($route)
    {
        $path = [];
        if (strpos($route, '?')) {
            $path = explode('?', $route)[0];
        } else {
            $path = $route;
        }

        return $path;
    }

    /**
     * redirect route using path or route name
     * 
     * @param $route | path or route
     */
    public static function redirect($route) {
        $is_route_matched = false;
        foreach(self::$routes as $rt) {
            if (str_contains($route, '/')) {
                if ($rt['method'] === 'GET' && $rt['route'] === $route) {
                    $is_route_matched = true;
                    $instance = new $rt['class']();
                    $instance->{$rt['callback']}();
                    return;
                }
            } else {
                if ($rt['name'] === $route) {
                    $is_route_matched = true;
                    $instance = new $rt['class']();
                    $instance->{$rt['callback']}();
                    return;
                }
            }
        }

        if (!$is_route_matched) {
            self::resolve404Page();
            return;
        }
    }
}
