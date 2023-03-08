<?php

namespace SF\Routing;

class Track
{
    private $action;
    private $params;

    public function __construct($action, $params = [])
    {
        $this->action = $action;
        $this->params = $params;
    }

    public function __get($prop)
    {
        return $this->$prop;
    }
}