<?php
namespace App\Helpers;

use Exception;
use ReflectionMethod;
use App\Models\Model;
use App\Helpers\Request;
use App\Middleware\RegisteredMiddlewares;

class Router {
    /**
     * @var array holds all routes
     */
    private static $routes = [];

    /**
     * @var String exception routes
     */
    private static $routeErrorPage = '/error';

    /**
     * @var Array array of allowed http methods
     */
    private static $methods = ['GET', 'POST', 'PUT', 'DELETE']; 


    /** =====================================
     *  MAIN METHODS
     *  =====================================*/

    /**
     * Calls this method when nothing is specified function name
     * 
     * @param String $method static function name (http method)
     * @param Array  $args arguments 
     */
    public static function __callStatic($method, $args)
    {
        if (in_array(strtoupper($method), self::$methods)) {
            $routeNameInitial = explode('\\', $args[1][0]);
            $formattedRoute  = [
                'method'     => strtoupper($method),
                'route'      => self::extractRoute($args[0]),
                'class'      => $args[1][0],
                'callback'   => $args[1][1],
                'name'       => str_replace('controller', '', strtolower(end($routeNameInitial).'.'.$args[1][1])),
                'params'     => [],
                'middleware' => [],
                'query'      => [],
            ];

            if (self::hasParams($formattedRoute['route'])) {
                $explodedRoute = explode(':', $formattedRoute['route']);
                $formattedRoute['route'] = substr($explodedRoute[0], 0, -1);
                
                foreach ($explodedRoute as $key => $value) {
                    if ($key) {
                        array_push($formattedRoute['params'], str_replace('/', '', $value));
                    }
                }
            }

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
        // start session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $is_route_matched = false;
        $route  = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // set attributes
        Request::setAttributes();

        foreach (self::$routes as $formattedRoute) {
            if ($formattedRoute['method'] === $method && $formattedRoute['route'] === self::extractRoute($route)) {
                $is_route_matched = true;
                
                // run middleware
                $middlewareRes = self::resolveMiddleware($formattedRoute);
                if (!$middlewareRes) {
                    return;
                }

                $instance = new $formattedRoute['class']();
                $instance->{$formattedRoute['callback']}();
                return;
            } else if (count($formattedRoute['params'])) {;
                // if (str_contains($formattedRoute['route'], self::extractRoute($route))) {
                if (self::compareRoute(self::extractRoute($route), $formattedRoute['route'])) {
                    if (self::resolveRouteWithParams($route, $formattedRoute)) {
                        return;
                    }
                }
            }
        }

        if (!$is_route_matched) {
            self::resolveErrorPage(404);
            return;
        }
    }

    /**
     * Resolve routes with parameters
     * 
     * @param string $route
     * @param string $routeToCompare
     * 
     * @return void
     */
    private static function resolveRouteWithParams($route, $formattedRoute)
    {
        // get route params
        $routeParams = explode('/', str_replace($formattedRoute['route'], '', $route));
        $routeParams = array_filter($routeParams, function ($item) { return $item; });
        
        if (count($routeParams) !== count($formattedRoute['params'])) {
            return false;
        }
        
        // get function params
        $params = new ReflectionMethod($formattedRoute['class'], $formattedRoute['callback']);
        $params = $params->getParameters();
        
        $parameters = [];
        foreach ($params as $key => $param) {
            $class = (string) $param->getType();
            $instance = $class ? new $class() : null;
            $p = array_values($routeParams);
            if (is_a($instance, Model::class)) {
                $instanceObject = $class::find($p[$key]);
                array_push($parameters, $instanceObject);
            } else {
                array_push($parameters, $p[$key]);
            }
        }

        $instance = new $formattedRoute['class']();
        $instance->{$formattedRoute['callback']}(...$parameters);
        return true;
    }

    /**
     * Resolves exception routes
     */
    private static function resolveErrorPage($code)
    {
        $routes = array_column(self::$routes, 'route');
        $routeIndex = array_search(self::$routeErrorPage, $routes);
        $formattedRoute = self::$routes[$routeIndex];

        $route = self::$routeErrorPage.'/'.$code;
        self::resolveRouteWithParams($route, $formattedRoute);
    }

    /**
     * redirect route using path or route name
     * 
     * @param $route | path or route
     */
    public static function redirect($route, $params = []) {
        $is_route_matched = false;
        foreach(self::$routes as $rt) {
            if (str_contains($route, '/')) {
                if ($rt['method'] === 'GET' && $rt['route'] === $route) {
                    $is_route_matched = true;
                    header('Location: ' . self::generateRouteParams($route, $params));
                    return;
                }
            } else {
                if ($rt['name'] === $route) {
                    $is_route_matched = true;
                    header('Location: ' . self::generateRouteParams($rt['route'], $params));
                    return;
                }
            }
        }

        if (!$is_route_matched) {
            self::resolveErrorPage(404);
            return;
        }
    }

    /**
     * Generate route params
     * 
     * @param String $route
     * @param Array  $params
     * 
     * @return String
     */
    private static function generateRouteParams($route, $params)
    {
        $queryParams = '?';

        foreach ($params as $key => $value) {
            if (!is_string($key)) {
                $route.="/$value";
            } else {
                $queryParams.= "$key=$value&";
            }
        }

        if (self::is_associative_array($params)) {
            $route = substr("$route$queryParams", 0, -1);
        }

        return $route;
    }

    /**
     * Set middleware
     * 
     * @param String   $name middleware name
     * @param callback $callback function
     * 
     * @return void
     */
    public static function middleware($name, $callback) {
        $routes = Router::$routes;

        Router::$routes = [];

        $callback();
        
        for ($ndx = 0;$ndx < count(Router::$routes);$ndx++) {
            array_push(Router::$routes[$ndx]['middleware'], $name);
        }

        Router::$routes = array_merge($routes, Router::$routes);
    }

    /**
     * Resolve middleware
     * 
     * @param String $name middleware name
     */

    private static function resolveMiddleware($route) {
        $middlewares = RegisteredMiddlewares::MIDDLEWARES;

        $is_not_auth = false;
        $is_handle_fail = false;

        foreach ($route['middleware'] as $name) {

            // throw exception
            if (!in_array($name, array_keys($middlewares))) throw new Exception("Can't resolve middleware '$name'");

            $instance = new $middlewares[$name]();

            if (!$instance::authorized()) {
                $is_not_auth = true;
                break;
            }

            if (!$instance::handle()) {
                $is_handle_fail = true;
                break;
            }
        }

        if ($is_not_auth) {
            self::resolveErrorPage(401);
            return false;
        }

        if ($is_handle_fail) {
            return false;
        }

        return true;
    }


    /**========================================
     * HELPER FUNCTIONS
     ==========================================*/

    /**
     * Valdidate array if it contains elemets with associations
     * 
     * @param array $array Array to be validated
     * 
     * @return bool
     */
    private static function is_associative_array($array)
    {
        $is_assoc = false;
        $keys = array_keys($array);
        foreach ($keys as $key) {
            if (is_string($key)) {
                $is_assoc = true;
            }
        }
        return $is_assoc;
    }

    /**
     * extract route path
     * 
     * @param $name Route name
     * 
     * @return String Route path
     */
    public function extract($name)
    {
        foreach (self::$routes as $route) {
            if ($route['name'] === $name) {
                return $route['route'];
            }
        }

        return "";
    }

    /**
     * Check route has params
     * 
     * @param $route
     * 
     * @return bool
     */
    private static function hasParams($route)
    {
        return str_contains($route, ":");
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
     * Compare route string
     * 
     * @param string $passed_route      passed route from browsers
     * @param string $registered_route  registered route
     * 
     * @return bool
     */

    private static function compareRoute($passed_route, $registered_route) : bool
    {
        $is_matched = true;
        $arr_passed = array_values(array_filter(explode('/', $passed_route)));
        $arr_registered = array_values(array_filter(explode('/', $registered_route)));

        $arr_to_comp = [];

        foreach ($arr_registered as $url_part) {
            if (!strpos($url_part, ':')) {
                array_push($arr_to_comp, $url_part);
            }
        }
        
        if (count($arr_to_comp) <= count($arr_passed)) {
            for ($ndx = 0;$ndx < count($arr_to_comp); $ndx++) {
                $passed_part = isset($arr_passed[$ndx]) ? $arr_passed[$ndx] : null;
                if ($passed_part != $arr_to_comp[$ndx]) {
                    $is_matched = false;
                    break;
                }
            }
        } else {
            $is_matched = false;
        }

        return $is_matched;
    }

    /**
     * Extract query parameters from routes
     * 
     * @param string $route Provided route
     * 
     * @return array query params
     */
    private static function resolveQueryParams($route) {
        $params = [];
        
        if (strpos($route, '?')) {
            $stringParams = explode('?', $route)[1];
            
            foreach (explode('&', $stringParams) as $pr) {
                $arr_pr = explode('=', $pr);
                $params[$arr_pr[0]] = isset($arr_pr[1]) && $arr_pr[1] ? $arr_pr[1] : null;
            }
        }

        return $params;
    }
}
