<?php
spl_autoload_register(static function ($className) {

    $path = str_replace('\\', '/', $className . '.php');

    if (file_exists($path))
        include_once($path);

});



$router = new core\Router($_GET['route']);
$router->run();