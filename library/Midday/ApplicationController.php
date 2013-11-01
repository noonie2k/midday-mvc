<?php namespace Midday;
/**
 * Contains the ApplicationController Class
 *
 * @package Controllers
 */

/**
 * Class ApplicationController
 * Parent class for all controllers
 *
 * @package Controllers
 */
class ApplicationController
{
    /**
     * Dynamically handle requests for a controller action
     *
     * @param string $action The controller action to perform
     * @param array $params Parameters to pass to the action
     */
    public function __call($action, $params)
    {
        $method = $action . 'Action';
        $this->_action = $action;
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            $controller = new ErrorController();
            $controller->index();
            die();
        }

        $this->_renderLayout();
    }

    /**
     * Render the page content
     */
    public function content()
    {
        $actionPartial = strtolower(preg_replace('/([A-Z])/', '-\1', $this->_action));
        $viewScript = 'app/views/scripts/' . lcfirst(str_replace('Controller', '', get_class($this))) . '/' . $actionPartial . '.phtml';
        include $viewScript;
    }

    /**
     * Render the page layout
     */
    protected function _renderLayout()
    {
        include 'app/views/layouts/default.phtml';
    }

    /**
     * The current controller action
     * @var string
     */
    protected $_action;

    /**
     * Data to pass to the view
     * @var array
     */
    public $data = array();
}
