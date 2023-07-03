<?php

use App\Helpers\Router;

/**
 * Extract route from a name
 * 
 * @param string $name
 * @param array  $args Put the params in order of the route params
 * 
 * @return string
 */
function route($name, $args = []) {
    
    if (!is_array($args)) {
        throw new Exception("Args must be an array");
        return;
    }

    $url = '';
    $route = [];
    foreach (Router::getRoutes() as $rt) {
        if ($rt['name'] == $name) {
            $route = $rt;
            break;
        }
    }

    if (!count($route)) {
        throw new Exception("Route not found");
        return;
    }

    if (count($route['params'])) {
        $arr_route = array_filter(explode('/', $route['route']));
        foreach ($arr_route as $route_part) {
            if (strpos($route_part, ':') !== false) {
                $url .= '/'.array_shift($args);
            } else {
                $url .= '/'.$route_part;
            }
        }
    } else {
        $url = $route['route'];
    }

    return $url;
}