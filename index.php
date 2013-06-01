<?php
@include 'php52hacks.php';

/**
 * Autoload source files
 *
 * @param string $className Class to instantiate
 */
function __autoload($className)
{
    $fileName = "{$className}.php";
    require_once $fileName;
}

$includePath = explode(PATH_SEPARATOR, get_include_path());
$includePath[] = realpath(dirname(__FILE__)) . '/app/controllers';
$includePath[] = realpath(dirname(__FILE__)) . '/app/library';
set_include_path(implode(PATH_SEPARATOR, $includePath));

$router = new Router();
$route = $router->route($_SERVER['REQUEST_URI']);

if (class_exists($route['controller'])) {
    $controller = new $route['controller']();
    $controller->$route['action']();
}