<?php
/**
 * Contains the Router Class
 *
 * @package Routing
 */

/**
 * Class Router
 * Routes traffic from a url to the correct controller/action
 *
 * @package Routing
 */
class Router {
    /**
     * Route the given uri to a controller action
     * <code>
     *     return array(
     *         'controller' => 'controllerName',
     *         'action'     => 'actionName',
     *         'params'     => array()
     *     );
     * </code>
     *
     * @param string $uri URI to route
     * @return array Controller, Action & Params
     */
    public function route($uri)
    {
        $uriParts = array();
        preg_match('/^\/([^\/]+)(?:\/([^\/]+))?(.+)?$/', $uri, $uriParts);
        array_shift($uriParts);

        $controller = array_shift($uriParts);
        $action = array_shift($uriParts);
        $params = array_shift($uriParts);

        if (!isset($controller)) $controller = 'home';
        if (!isset($action))     $action     = 'index';
        if (!isset($params))     $params     = array();

        return array(
            'controller' => ucfirst(strtolower($controller)) . 'Controller',
            'action'     => strtolower($action),
            'params'     => $params
        );
    }
}