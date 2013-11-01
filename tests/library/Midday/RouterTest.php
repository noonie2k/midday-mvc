<?php

class RouterTest extends PHPUnit_Framework_TestCase
{
    public function testDefaultControllerAndAction()
    {
        $router = new Midday\Router();
        $this->assertEquals(
            array(
                'controller' => 'HomeController',
                'action'     => 'index',
                'params'     => array()
            ),
            $router->route('/')
        );
    }

    public function testGivenControllerAndDefaultAction()
    {
        $router = new Midday\Router();
        $this->assertEquals(
            array(
                'controller' => 'FeedController',
                'action'     => 'index',
                'params'     => array()
            ),
            $router->route('/feed')
        );
    }

    public function testGivenControllerAndAction()
    {
        $router = new Midday\Router();
        $this->assertEquals(
            array(
                'controller' => 'FeedController',
                'action'     => 'item',
                'params'     => array()
            ),
            $router->route('/feed/item')
        );
    }

    public function testGivenControllerWithDashesAndDefaultAction()
    {
        $router = new Midday\Router();
        $this->assertEquals(
            array(
                'controller' => 'AboutMeController',
                'action'     => 'index',
                'params'     => array()
            ),
            $router->route('/about-me')
        );
    }

    public function testGivenControllerWithDashesAndAction()
    {
        $router = new Midday\Router();
        $this->assertEquals(
            array(
                'controller' => 'AboutMeController',
                'action'     => 'childhoodLife',
                'params'     => array()
            ),
            $router->route('/about-me/childhood-life')
        );
    }

    public function testNoParams()
    {
        $router = new Midday\Router();
        $this->assertEquals(
            array(
                'controller' => 'FeedController',
                'action'     => 'item',
                'params'     => array()
            ),
            $router->route('/feed/item')
        );
    }

    public function testSingleParam()
    {
        $router = new Midday\Router();
        $this->assertEquals(
            array(
                'controller' => 'FeedController',
                'action'     => 'item',
                'params'     => array('1')
            ),
            $router->route('/feed/item/1')
        );
    }

    public function testMultipleParams()
    {
        $router = new Midday\Router();
        $this->assertEquals(
            array(
                'controller' => 'FeedController',
                'action'     => 'item',
                'params'     => array('1','2')
            ),
            $router->route('/feed/item/1/2')
        );
    }

    public function testDefinedRoutePassingOptionalPart()
    {
        $routingConfig = array(
            'althome' => array(
                'route'      => '/althome/(?P<params>.+)?',
                'controller' => 'Home',
                'action'     => 'index'
            )
        );

        $router = new Midday\Router($routingConfig);
        $this->assertEquals(
            array(
                'controller' => 'HomeController',
                'action'     => 'index',
                'params'     => array('1', '2')
            ),
            $router->route('/althome/1/2')
        );
    }

    public function testDefinedRouteWithoutPassingOptionalPart()
    {
        $routingConfig = array(
            'althome' => array(
                'route'      => '/althome/(?P<params>.+)?',
                'controller' => 'Home',
                'action'     => 'index'
            )
        );

        $router = new Midday\Router($routingConfig);
        $this->assertEquals(
            array(
                'controller' => 'HomeController',
                'action'     => 'index',
                'params'     => array()
            ),
            $router->route('/althome')
        );
    }

    public function testDefinedRoutePartialMatch()
    {
        $routingConfig = array(
            'althome' => array(
                'route'      => '/althome/(?P<params>.+)?',
                'controller' => 'Home',
                'action'     => 'index'
            )
        );

        $router = new Midday\Router($routingConfig);
        $this->assertEquals(
            array(
                'controller' => 'AlthomesomethingelseController',
                'action'     => 'index',
                'params'     => array()
            ),
            $router->route('/althomesomethingelse')
        );
    }

    public function testDefinedRouteWithDashes()
    {
        $routingConfig = array(
            'call-me' => array(
                'route'      => '/call-me',
                'controller' => 'Home',
                'action'     => 'callMe'
            )
        );

        $router = new Midday\Router($routingConfig);
        $this->assertEquals(
            array(
                'controller' => 'HomeController',
                'action'     => 'callMe',
                'params'     => array()
            ),
            $router->route('/call-me')
        );
    }
}
