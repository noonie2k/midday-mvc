<?php namespace Midday;
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
     * Create a routing object based on the provided routing file
     * <code>
     *     $routingConfig = array(
     *         'routename' => array(
     *             'controller' => 'ControllerName',
     *             'action'     => 'ActionName',
     *             'route'      => 'Route Pattern' (e.g. /path/path/?optional
     * @param array $routingConfig JSON Routing Configuration
     */
    public function __construct($routingConfig = array())
    {
        $this->_config = $routingConfig;
    }

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
        $this->_uri = rtrim($uri, '/');

        $route = $this->_definedRoute();
        if (empty($route)) {
            $route = $this->_simpleRoute();
        }

        return $route;
    }

    /**
     * Perform a routing based on the uri pattern /controller/actions/param/param
     *
     * @return array
     */
    protected function _simpleRoute()
    {
        $uriParts = explode('/', $this->_uri);
        array_shift($uriParts);
        $controller = $this->_convertCase(array_shift($uriParts));
        $action = $this->_convertCase(array_shift($uriParts));
        $params = $uriParts;

        if (empty($controller)) $controller = 'Home';
        if (empty($action)) $action = 'index';
        if (empty($params)) $params = array();

        return array(
            'controller' => $controller . 'Controller',
            'action' => lcfirst($action),
            'params' => $params
        );
    }

    /**
     * Perform a routing based on the patterns defined in the config file
     *
     * @return array
     */
    protected function _definedRoute()
    {
        if (substr($this->_uri, -1) !== '/') {
            $uri = $this->_uri . '/';
        } else {
            $uri = $this->_uri;
        }

        $route = array();

        foreach ($this->_config as $routeConfig) {
            $routePattern = '/' . str_replace('/', '\/', $routeConfig['route']) . '/';
            $matches = array();
            if (preg_match($routePattern, $uri, $matches) === 1) {
                $params = array();
                if (isset($matches['params'])) {
                    $params = explode('/', rtrim($matches['params'], '/'));
                }
                $route = array(
                    'controller' => $routeConfig['controller'] . 'Controller',
                    'action' => $routeConfig['action'],
                    'params' => $params
                );
            }
        }

        return $route;
    }

    /**
     * Convert a dashed string to Camel Case (upper or lower depending the option passed)
     *
     * @param string $unconverted Unconverted string
     * @return string Camel Case String
     */
    protected function _convertCase($unconverted)
    {
        $converted = '';
        if (strpos($unconverted, '-') !== false) {
            $parts = explode('-', $unconverted);
            foreach ($parts as $part) {
                $converted .= ucfirst($part);
            }
        } else {
            $converted = ucfirst($unconverted);
        }

        return $converted;
    }

    /**
     * URI to route
     *
     * @var string
     */
    protected $_uri = '';

    /**
     * Routing configuration
     *
     * @var array
     */
    protected $_config = array();
}
