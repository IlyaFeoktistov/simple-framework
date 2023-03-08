<?php

namespace SF\Routing;

class Route
{
    private $method;
    private $path;
    private $action;
    private $params;

    public function __construct($method, $path, $action, $params = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->action = $action;
        $this->params = $params;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }
}