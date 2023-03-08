<?php

namespace SF\Support;

class ClassAutoloader
{
    public static function run()
    {
        spl_autoload_register(function($class)
        {
            $pattern = '#^(?<nameSpace>.+)\\\\(?<className>.+)$#';

            if(preg_match($pattern, $class, $matches))
            {
                $path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . strtolower($matches['nameSpace']) . DIRECTORY_SEPARATOR . $matches['className'] . '.php';

                if(file_exists($path))
                {
                    include $path;
                }
                else
                {
                    throw new \Exception("Ошибка подключения класса: файл по пути $path не найден");
                }
            }
        });
    }
}