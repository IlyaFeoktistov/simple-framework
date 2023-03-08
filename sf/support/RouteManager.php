<?php

namespace SF\Support;

class RouteManager
{
    public static function addRoutes($fileName)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/app/routing/' . $fileName . '.php';

        if(file_exists($path))
        {
            include_once $path;
        }
        else
        {
            throw new \Exception("Ошибка инициализации роутов: файла $path не существует");
        }
    }
}