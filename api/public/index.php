<?php

/**
 * @category     Product_Test
 * @package      sc
 * @author       Ali Eltahan <info@alieltahan.com>
 */

use Core\Router\Router;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    require base_path("$class.php");
});

require base_path('bootstrap.php');

$router = new Router();
$routes = require base_path('Core/Router/routes.php');
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$router->route($uri, $_SERVER['REQUEST_METHOD']);
