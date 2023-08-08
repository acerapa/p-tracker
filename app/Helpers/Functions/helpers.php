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

/**
 * Get the path to the Public folder
 * 
 * @param string $path
 * 
 * @return string
 */
function public_path($path = '') {
    return dirname(dirname(__DIR__)).'/Public/'.$path;
}

/**
 * Get assests path
 * 
 * @param string $path
 */
function asset($directory, $file) {
    $directory = encrypt($directory);
    $file = encrypt($file);
    return route('static.getfile', [$directory, $file]);
}

/**
 * Function that encrypts a string in a two way use case
 * 
 * @param string $string
 * 
 * @return string
 */
function encrypt($string) {
    $key = $_ENV['APP_KEY'];
    $iv = $_ENV['APP_IV'];
    $cipher = $_ENV['APP_CIPHER'];

    # code to replace all / to .
    $string = str_replace('/', '=slash=', $string);

    $encrypted = openssl_encrypt($string, $cipher, $key, 0, $iv);

    # code to replace all / to - in encrypted string
    $encrypted = str_replace('/', '-', $encrypted);

    return $encrypted;
}

/**
 * Function that decrypts a string result from the encrypt function
 * 
 * @param string $string
 * 
 * @return string
*/
function decrypt($string) {
    $key = $_ENV['APP_KEY'];
    $iv = $_ENV['APP_IV'];
    $cipher = $_ENV['APP_CIPHER'];
    
    # code to replace all - to / in encrypted string
    $string = str_replace('-', '/', $string);

    $decrypted = openssl_decrypt($string, $cipher, $key, 0, $iv);

    $decrypted = str_replace('=slash=', '/', $decrypted);

    return $decrypted;
}