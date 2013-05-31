<?php
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
$router->route($_SERVER['REQUEST_URI']);