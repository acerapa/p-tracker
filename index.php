<?php
    
    // Initailized connection to database
    include_once('./app/Config/Database.php');
    
    // imports
    require_once __DIR__.'/vendor/autoload.php';

    // load env
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // initialize connection
    $db = new Database();
    if (!$db->getConnectionStatus()['success']) {
        // Redirect to the error page
        $_SERVER['REQUEST_URI'] = '/error/sql';
    }

    // Import the router file
    include('./app/Router/router.php');
    