<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/app.css" />
</head>
<body>
<?php
function __autoload($className)
{
    $fileName = "{$className}.php";
    @include_once $fileName;
}

$includePath = explode(PATH_SEPARATOR, get_include_path());
$includePath[] = realpath(dirname(__FILE__)) . '/app/controllers';
set_include_path(implode(PATH_SEPARATOR, $includePath));

$requestUri = $_SERVER['REQUEST_URI'];

$requestParts = explode('/', $requestUri);
array_shift($requestParts);

$controller = array_shift($requestParts);
$action = array_shift($requestParts);

$params = array();
foreach ($requestParts as $part) {
    $params[] = $part;
}

if (empty($controller)) $controller = 'home';
if (empty($action))     $action = 'index';

$controllerClass = ucfirst($controller) . 'Controller';
if (class_exists($controllerClass)) {
    $controllerObject = new $controllerClass();
    $actionMethod = $action . 'Action';
    $controllerObject->$actionMethod();
} else {
    $routes = json_decode(file_get_contents('app/config/routes.json'));
    $found = false;
    foreach ($routes as $route) {
        if (preg_match($route->pattern, $requestUri) === 1) {
            $controllerClass = ucfirst($route->controller) . 'Controller';
            if (class_exists($controllerClass)) {
                $controllerObject = new $controllerClass();
                $actionMethod = $route->action . 'Action';
                $controllerObject->$actionMethod();
                $found = true;
                break;
            }
        }
    }

    if ($found === false) {
        $controller = new ErrorController();
        $controller->indexAction();
    }
}
?>
</body>
</html>