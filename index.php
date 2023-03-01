<?php
    
    // Initailized connection to database
    include_once('./config/Database.php');
    
    // load .env files
    include('./helpers/EnvironmentVariable.php');

    // initialize connection
    $db = new Database();
    if (!$db->getConnectionStatus()['success']) {
        // Redirect to the error page
        $_SERVER['REQUEST_URI'] = '/error/sql';
    }

    // Import the router file
    include('./router/router.php');
    