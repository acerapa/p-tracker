<?php
namespace App\Helpers;

use Exception;
use ReflectionMethod;
use App\Models\Model;
use App\Helpers\Request;
use App\Middleware\RegisteredMiddlewares;

class Router {
    /**
     * @var Array current route
     */
    private static $currentRoute = [];

    /**
     * @var array holds all routes
     */
    private static $routes = [];

    /**
     * @var String exception routes
     */
    private static $routeErrorPage = '/error/:code';

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
        // check arguments
        if (count($args) < 2) {
            throw new Exception("Invalid number of arguments: parameters must be (route: required, callback: required, middleware: optional (array))");
            return;
        }

        // check middleware argument
        $middlewares = [];
        if (isset($args[2]) && is_array($args[2])) {
            $middlewares = $args[2];
        }   

        if (in_array(strtoupper($method), self::$methods)) {
            $routeNameInitial = explode('\\', $args[1][0]);
            $formattedRoute  = [
                'method'     => strtoupper($method),
                'route'      => self::extractRoute($args[0]),
                'class'      => $args[1][0],
                'callback'   => $args[1][1],
                'name'       => str_replace('controller', '', strtolower(end($routeNameInitial).'.'.$args[1][1])),
                'params'     => [],
                'middleware' => $middlewares,
                'query'      => [],
            ];

            // extract route params
            if (self::hasParams($formattedRoute['route'])) {
                $formattedRoute['params'] = self::getParamsFromRoute($formattedRoute['route']);
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

        // generate csrf token
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        $is_route_matched = false;
        $route  = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        // set attributes
        Request::setAttributes();

        foreach (self::$routes as $formattedRoute) {
            
            if (self::compareRoute(self::extractRoute($route), $formattedRoute, $method)) {
                $is_route_matched = true;
                
                // run middleware
                $middlewareRes = self::resolveMiddleware($formattedRoute);
                if (!$middlewareRes) {
                    return;
                }

                // check if route has parameters
                if (count($formattedRoute['params'])) {
                    if (self::resolveRouteWithParams($route, $formattedRoute)) {
                        return;
                    }
                }

                Request::$route = $formattedRoute;
                self::$currentRoute = $formattedRoute;

                $instance = new $formattedRoute['class']();
                $instance->{$formattedRoute['callback']}();
                return;
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
        // get route param values
        
        $arr_passed = array_filter(explode('/',$route));
        $arr_registered = array_filter(explode('/',$formattedRoute['route']));

        $routeParams = [];
        foreach ($arr_registered as $ndx => $param) {
            if (strstr($param, ':')) {
                $routeParams[$param] = $arr_passed[$ndx];
            }
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

        Request::$route = $formattedRoute;
        self::$currentRoute = $formattedRoute;

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

        $route = str_replace('/:code', '', self::$routeErrorPage).'/'.$code;
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
            array_unshift(Router::$routes[$ndx]['middleware'], $name);
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
     * GETTER FUNCTIONS
     ==========================================*/

    /**
     * Get current route
     * 
     * @return Array
    */
    public static function getCurrentRoute() : Array
    {
        return self::$currentRoute;
    }


    /**
     * Get all routes
     * 
     * @return Array
     */
    public static function getRoutes() : Array
    {
        return self::$routes;
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
     * Get route params
     * 
     * @param  string $route Route passed from browsers
     * 
     * @return Array  $params array of route parameters
     */

    private static function getParamsFromRoute($route)
    {
        $params = [];
        $route = explode('/', $route);
        $route = array_values(array_filter($route));

        foreach ($route as $key => $value) {
            if (str_contains($value, ':')) {
                $params[] = str_replace(':', '', $value);
            }
        }

        return $params;
    }

    /**
     * Extract route path and route params queries
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
     * @param string $passed_method     passed method from browsers
     * 
     * @return bool
     */

    private static function compareRoute($passed_route, $registered_route, $passed_method) : bool
    {
        $arr_passed = array_values(array_filter(explode('/', $passed_route)));
        $arr_registered = array_values(array_filter(explode('/', $registered_route['route'])));

        if (count($arr_passed) != count($arr_registered) || $passed_method != $registered_route['method']) {
            return false;
        }
        
        $is_uri_matched = true;
        for ($ndx = 0;$ndx < count($arr_passed); $ndx++) {
            if (strstr($arr_registered[$ndx], ':')) {
                continue;
            }

            if ($arr_passed[$ndx] != $arr_registered[$ndx]) {
                $is_uri_matched = false;
            }
        }
        
        return $is_uri_matched;
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
