#!/usr/bin/php php
<?php
$args = getopt(null,['serve', 'port::', 'p::', 'exportdb']);

startServer($args);
/**
 * Start a development server
 * 
 * @return Void
 */
function startServer($args)
{
    $port = isset($args['p']) ? $args['p'] : null;
    if (!$port) {
        $port = isset($args['port']) ? $args['port'] : 8000;
    }

    if (is_array($args)) {
        if (array_key_exists('serve', $args)) {
            shell_exec("php -S 127.0.0.1:$port");
        } elseif (array_key_exists('exportdb', $args)) {
            // imports
            require_once __DIR__.'/vendor/autoload.php';

            // load env
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();
            
            shell_exec("mysqldump -u " . $_ENV['DB_USERNAME'] . " -p " . $_ENV['DB_DATABASE'] . " > " . $_ENV['DB_DATABASE'] . ".sql");
            echo "Successfully exported!";
        }
    }
}