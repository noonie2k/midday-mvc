<?php

class HomeController extends ApplicationController {
    public function indexAction()
    {
        $this->data['test'] = 'Something cool';
    }

    public function contactAction()
    {
    }
}