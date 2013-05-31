<?php

class Router {
    public function __construct($uri)
    {
        $this->_uri = $uri;
    }

    public function route()
    {
        $simpleRoute = $this->_getSimpleRoute();
        $controllerClass = ucfirst($simpleRoute['controller']) . 'Controller';
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            $action = $simpleRoute['action'];
            $controller->$action();
            return;
        }

        $errorController = new ErrorController();
        $errorController->index();
    }

    protected function _getSimpleRoute()
    {
        $requestParts = explode('/', $this->_uri);
        array_shift($requestParts);

        $controller = array_shift($requestParts);
        $action = array_shift($requestParts);

        $params = array();
        foreach ($requestParts as $part) {
            $params[] = $part;
        }

        if (empty($controller)) $controller = 'home';
        if (empty($action))     $action = 'index';

        return array(
            'controller' => $controller,
            'action'     => $action,
            'params'     => $params
        );
    }

    protected $_uri = '';
}