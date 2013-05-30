<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="/css/app.css" />
</head>
<body>
<?php
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

    $viewFile = "app/views/${controller}/${action}.php";
    if (file_exists($viewFile)) {
        include $viewFile;
    } else {
        $viewFile = 'app/views/error/index.php';

        $routes = json_decode(file_get_contents('app/config/routes.json'));
        foreach ($routes as $route) {
            if (preg_match($route->pattern, $requestUri) === 1) {
                $viewFile = "app/views/{$route->controller}/{$route->action}.php";
            }
        }
        include $viewFile;
    }
?>
</body>
</html>