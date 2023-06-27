<?php
namespace App\Middleware;

class RegisteredMiddlewares {
    const MIDDLEWARES = [
        'auth' => \App\Middleware\Define\AuthMiddleware::class,
        'page' => \App\Middleware\Define\PageMiddleware::class,
        'csrf' => \App\Middleware\Define\CsrfMiddleware::class,
    ];
}