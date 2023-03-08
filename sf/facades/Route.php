<?php

namespace SF\Facades;

use SF\Foundation\Application;

class Route
{
    public static function get(string $path, string|callable $action, $params = [])
    {
        Application::get()->getRouter()->addRoute('GET', $path, $action, $params);
    }

    public static function post(string $path, string|callable $action, $params = [])
    {
        Application::get()->getRouter()->addRoute('POST', $path, $action, $params);
    }
}