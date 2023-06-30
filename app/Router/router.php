<?php
use App\Helpers\Router;

// Controllers
use App\Controllers\AppController;
use App\Controllers\AuthController;
use App\Controllers\UserController;
use App\Controllers\ExceptionController;
use App\Controllers\TodoController;

// web routes

// testing middleware
Router::middleware('auth', function () {
    Router::get('/', [AppController::class, 'index']);
    Router::get('/?i=1', [AppController::class, 'index']);

    // activity routes
    Router::get('/activity', [AppController::class, 'activity']);

    // user routes
    Router::get('/user/list', [UserController::class, 'list']);
    Router::post('/user/edit/:user', [UserController::class, 'edit']);
    Router::post('/user/update/:user', [UserController::class, 'update']);
    Router::post('/user/delete/:user', [UserController::class, 'destroy']);
    Router::post('/profile/update', [UserController::class, 'updateProfile'], ['csrf']);

    // todos routes
    Router::get('/todo', [TodoController::class, 'index']);

    // logout route
    Router::get('/logout', [AuthController::class, 'logout']);
});

Router::middleware('page', function () {
    Router::get('/login', [AuthController::class, 'loginPage']);
    Router::post('/login', [AuthController::class, 'authenticateLogin'], ['csrf']);
    Router::get('/register', [AuthController::class, 'registerPage']);
    Router::post('/register', [UserController::class, 'store']);
});

// api routes
Router::get('/api/user/list', [UserController::class, 'userList']);


// boot exception routes
ExceptionController::bootExceptionRoute();

// resolve routes
Router::run();
