<?php
namespace App\Interfaces;

interface IMiddleware {

    /**
     * Authenticated
     */
    public static function authorized();

    /**
     * Handle
     */
    public static function handle();
}
