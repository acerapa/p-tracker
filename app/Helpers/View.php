<?php

namespace App\Helpers;

use App\Helpers\Request;
use Exception;

class View
{

    public static $layout_path = 'layouts';

    /**
     * Constructor
     */
    function __construct($path, $args = [])
    {
        $route = Request::$route;

        extract($args);

        return include($path);
    }


    /**
     * Get the view path
     */
    public static function view_path($path='views')
    {
        $view_path = $_SERVER['DOCUMENT_ROOT']."/app/$path";

        if (!is_dir($view_path)) {
            throw new Exception("$path directory does'nt exist!");
            return;
        }

        return $view_path;
    }


    /**
     * Include the layout file
     * 
     * @param string $name Specify the layout name
     * @param array $defined_vars Specify the variables to be passed to the layout
     * @param string $layout_path Specify the path to the layouts folder
     * 
     * @return void
     */
    public static function use_layout($name, $defined_vars, $layout_path = 'layouts')
    {
        $dir_path = self::view_path()."/$layout_path";

        if (!is_dir($dir_path)) {
            throw new Exception("$layout_path directory does'nt exist!");
            return;
        }

        if (!file_exists("$dir_path/$name.php")) {
            throw new Exception("Layout Does'nt exist: $name !");
            return;
        }

        extract($defined_vars);
        include("$dir_path/$name.php");
    }
}
