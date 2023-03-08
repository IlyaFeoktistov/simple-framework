<?php

namespace SF\Foundation;

use SF\Routing\Router;
use SF\Routing\Dispatcher;
use SF\Routing\View;
use SF\Support\RouteManager;

class Application
{
    private static $instance = null;
    private $router;
    private $routeManager;
    private $config;

    private function __construct() 
    {
        $this->router = new Router;
        $this->routeManager = new RouteManager;
        $this->config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/app/config/app.ini', true);
    }

    public function addRouteMap($path)
    {
        $this->routeManager->addRoutes($path);
        return $this;
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function getAppConfig()
    {
        return $this->config;
    }

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $track = $this->router->getTrack($uri);
        
        $dispatcher = new Dispatcher;
        $actionResult = $dispatcher->getActionResult($track);

        if($actionResult instanceof View)
        {
            echo $actionResult->render();
        }
        else
        {
            echo $actionResult;
        }
    }

    public static function get()
    {
        return self::$instance ??= new self;
    }

    public final function __clone() {}
}
