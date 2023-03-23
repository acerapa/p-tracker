<?php
    // imports
    require_once __DIR__.'/vendor/autoload.php';

    // load env
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // Import the router file
    include('./app/Router/router.php');
