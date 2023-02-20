<?php
// imports
require_once realpath(dirname(__DIR__).'/vendor/autoload.php');

// load env
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
