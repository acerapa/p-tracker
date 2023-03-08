<?php
    $request = $_SERVER['REQUEST_URI'];
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    
    $BASE_PATH = dirname(__DIR__);

    use App\Helpers\Router;

    
    // Controllers
    use App\Controllers\AuthController;
    use App\Controllers\UserController;
    
    Router::get('/login', [AuthController::class, 'loginPage']);

    // Testing only
    // include("$BASE_PATH/api/user/add.php");
    
    // Simple router with switch case

    // switch ($request) {
    //     // welcome page
    //     case '/':
    //     case '/?i=1':
    //         include("$BASE_PATH/views/welcome.php");
    //         break;
    //     case '/login':
    //         (new AuthController())->loginPage();
    //         break;
    //     case '/register':
    //         (new AuthController())->registerPage();
    //         break;
    //     // User home page
    //     case '/home':
    //         include("$BASE_PATH/views/user/index.php");
    //         break;

    //     // API part
    //     case '/imgcont/users': 
    //         include("$BASE_PATH/api/user/read.php");
    //         break;

    //     case '/user/add':
    //         if ($requestMethod == 'POST') {
    //             // include("$BASE_PATH/api/user/add.php");
    //             (new UserController())->store();
    //         }
    //         echo "<p>GET is not supported in this route!</p>";
    //         break;
    //     case '/user/rem':
    //         $_SERVER['REQUEST_METHOD'] = 'DELETE';
    //         include("$BASE_PATH/api/user/delete.php");
    //         break;
    //     // admin
    //     case '/imgcont/admin':
    //         include("$BASE_PATH/views/admin/index.php");
    //         break;
    //     // Errors part
    //     case '/error/404':
    //         include("$BASE_PATH/views/errors/404.php");
    //         break;    
    //     case '/error/sql':
    //         include("$BASE_PATH/views/errors/sql.php");
    //         break;
    //     default:
    //         include("$BASE_PATH/views/errors/404.php");
    //         break;
    // }

    /**
     * Redirects to the given route
     * 
     * @param string $route
     */
    function redirect($route)
    {
        $_SERVER['REQUEST_URI'] = $route;
    }
