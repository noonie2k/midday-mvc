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
        $uriParts = array();
        preg_match('/^\/([^\/]+)(?:\/([^\/]+))?(.+)?$/', $uri, $uriParts);
        array_shift($uriParts);

        $controller = array_shift($uriParts);
        $action     = array_shift($uriParts);
        $params     = array_shift($uriParts);

        if (!isset($controller)) $controller = 'home';
        if (!isset($action))     $action     = 'index';
        if (!isset($params))     $params     = '';

        $paramList = $this->_parseParams($params);

        return array(
            'controller' => ucfirst(strtolower($controller)) . 'Controller',
            'action'     => strtolower($action),
            'params'     => $paramList
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