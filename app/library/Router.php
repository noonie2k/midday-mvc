<?php

/**
 * Class Router
 * Routes traffic from a url to the correct controller/action
 *
 * @package Routing
 */
class Router {
    /**
     * Route the given uri to a controller action
     *
     * @param string $uri URI to route
     */
    public function route($uri)
    {
        $this->_uri = $uri;
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

    /**
     * Get the Route based on a simple /controller/action/params uri pattern
     * Controller and Action default to Home and index respectively if not given
     *
     * <code>
     *     return array(
     *         'controller' => 'controllerName',
     *         'action'     => 'actionName',
     *         'params'     => array()
     *     );
     * </code>
     *
     * @return array
     */
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