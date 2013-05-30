<?php

class HomeController {
    public function indexAction()
    {
        $controller = lcfirst(str_replace('Controller', '', __CLASS__));
        $view = lcfirst(str_replace('Action', '', __FUNCTION__));
        $file = 'app/views/' . $controller . '/' . $view . '.php';
        include $file;
    }

    public function contactAction()
    {
        $controller = lcfirst(str_replace('Controller', '', __CLASS__));
        $view = lcfirst(str_replace('Action', '', __FUNCTION__));
        $file = 'app/views/' . $controller . '/' . $view . '.php';
        include $file;
    }
}