<?php

class ApplicationController {
    public function __call($method, $params)
    {
        $action = $method . 'Action';
        if (method_exists($this, $action)) {
            $this->$action();
            $view = 'app/views/' . lcfirst(str_replace('Controller', '', get_class($this))) . '/' . $method . '.php';
            include $view;
        } else {
            $controller = new ErrorController();
            $controller->index();
        }
    }
}