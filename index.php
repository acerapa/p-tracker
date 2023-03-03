<?php
    // imports
    require_once __DIR__.'/vendor/autoload.php';
    
    // Initailized connection to database
    use App\Config\Database;

    // load env
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // initialize connection
    $db = new Database();
    if (!$db->isConnected()) {
        // Redirect to the error page
        $_SERVER['REQUEST_URI'] = '/error/sql';
    }

    // Import the router file
    include('./app/Router/router.php');
    