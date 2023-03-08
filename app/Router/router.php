<?php
use App\Helpers\Router;

// Controllers
use App\Controllers\AppController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\ExceptionController;


// routes
Router::get('/', [AppController::class, 'index']);
Router::get('/?i=1', [AppController::class, 'index']);
Router::get('/login', [AuthController::class, 'loginPage']);
Router::get('/register', [AuthController::class, 'registerPage']);

// boot exception routes
ExceptionController::bootExceptionRoute();