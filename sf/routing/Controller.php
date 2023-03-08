<?php

namespace SF\Routing;

class Controller
{
    protected $viewData = [];
    
    protected function view($page, $params = [], $layout = '_default')
    {
        return new View($page, $params, $this->viewData, $layout);
    }
}