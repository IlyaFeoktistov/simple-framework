<?php

namespace SF\Routing;

class Dispatcher
{
    public function getActionResult(Track $track)
    {
        if(is_callable($track->action))
        {
            return ($track->action)($track->params);
        }

        if(preg_match('#^(?<controller>[a-zA-Z0-9]+)@(?<action>[a-zA-Z0-9]+)$#', $track->action, $matches))
        {
            $controller = ucfirst($matches['controller']) . 'Controller';
            $fullName = "App\\Controllers\\$controller";
            
            $controller = new $fullName;
            
            if(method_exists($controller, $matches['action']))
            {
                return $controller->{$matches['action']}($track->params);
            }

            throw new \Exception("Ошибка вызова метода: метод $fullName->{$matches['action']} несущетсвует");
        }

        throw new \Exception("Ошибка шаблона роута: неверный шаблон, шаблон должен выглядеть controller@action");
    }
}