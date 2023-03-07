<?php
namespace App\Interfaces;

interface Route {
    /**
     * Get method routes
     */
    public function get($route, $callback);
}
