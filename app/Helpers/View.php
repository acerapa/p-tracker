<?php

namespace App\Helpers;

use App\Helpers\Request;

class View {
    /**
     * Constructor
     */
    function __construct($path, $args = [])
    {
        $route = Request::$route;

        extract($args);

        return include($path);
    }
}