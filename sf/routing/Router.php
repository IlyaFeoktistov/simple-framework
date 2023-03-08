<?php

namespace SF\Routing;

class Router
{
    private $routes = [];

    public function addRoute($method, $path, $action, $params = [])
    {
        $this->routes[] = new Route($method, $path, $action, $params);
    }

    public function getTrack($uri)
    {
        foreach($this->routes as $route)
        {
            $pattern = $this->createPattern($route->path);

            if(preg_match($pattern, $uri, $params))
            {
                $params = $this->clearParams($params);
                $params = array_merge($params, $route->params);
                
                return new Track($route->action, $params);
            }
        }

        return new Track('error@notFound');
    }

    private function createPattern($subject)
    {
        $pattern = '#/{([^/]+)}#';
        $replacement = '/(?<$1>[^/]+)';
        return '#^' . preg_replace($pattern, $replacement, $subject) . '/?$#';
    }

    private function clearParams($params)
    {
        $result = [];

        foreach($params as $key => $value)
        {
            if(!is_int($key))
            {
                $params[$key] = $value;
            }
        }

        return $result;
    }
}