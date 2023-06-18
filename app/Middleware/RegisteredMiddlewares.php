<?php
namespace App\Middleware;

class RegisteredMiddlewares {
    const MIDDLEWARES = [
        'auth' => \App\Middleware\Define\AuthMiddleware::class
    ];
}