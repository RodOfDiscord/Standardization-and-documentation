<?php
spl_autoload_register(static function ($className) {
    // Convert namespace to full file path
    $path = str_replace('\\', '/', $className) . '.php';

    // Check if the file exists before including it
    if (file_exists($path)) {
        include_once($path);
    } else {
        // Handle the error appropriately if the file doesn't exist
        error_log("File not found: $path");
    }
});

// Ensure that 'route' is set in the $_GET array
$route = isset($_GET['route']) ? $_GET['route'] : '';

$router = new core\Router($route);

$router->run();
