#!/usr/bin/php php
<?php
$args = getopt(null,['serve', 'port::', 'p::']);
// var_dump($args);


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
        }
    }
}