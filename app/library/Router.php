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
class Router
{
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
        $uriParts = explode('/', $uri);
        array_shift($uriParts);

        $controller = array_shift($uriParts);
        $action     = array_shift($uriParts);
        $params     = $uriParts;

        if (empty($controller)) $controller = 'home';
        if (empty($action))     $action     = 'index';
        if (empty($params))     $params     = array();

        return array(
            'controller' => ucfirst(strtolower($controller)) . 'Controller',
            'action'     => strtolower($action),
            'params'     => $params
        );
    }

    /**
     * Parse Parameter part of the URI into a parameter list
     *
     * @param string $params The Parameter List
     * @return array List of parameter values
     */
    protected function _parseParams($params)
    {
        $paramList = array();
        if (!empty($params)) {
            preg_match_all('/[^\/]+/', $params, $paramList);
            $paramList = array_shift($paramList);
            return $paramList;
        }
        return $paramList;
    }
}