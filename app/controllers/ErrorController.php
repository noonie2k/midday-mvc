<?php

class ErrorController {
    public function indexAction()
    {
        $controller = lcfirst(str_replace('Controller', '', __CLASS__));
        $view = lcfirst(str_replace('Action', '', __FUNCTION__));
        $file = 'app/views/' . $controller . '/' . $view. '.php';
        include $file;
    }
}