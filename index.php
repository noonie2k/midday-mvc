<?php
$includePath = explode(PATH_SEPARATOR, get_include_path());
$includePath[] = realpath(dirname(__FILE__)) . '/app/controllers';
$includePath[] = realpath(dirname(__FILE__)) . '/library';
set_include_path(implode(PATH_SEPARATOR, $includePath));

require 'Midday/AutoLoader.php';

$routerConfig = json_decode(
    file_get_contents(realpath(dirname(__FILE__)) . '/app/config/routes.json'),
    true
);
$router = new Midday\Router($routerConfig);
$route = $router->route($_SERVER['REQUEST_URI']);

if (class_exists($route['controller'])) {
    $controller = new $route['controller']();
    $controller->$route['action']($route['params']);
}
