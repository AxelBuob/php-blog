<?php

namespace Core;

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class)
    {
        if (strpos($class, __NAMESPACE__) === 0) {
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            $file = __DIR__ . '/' . $class . '.php';
            require $file;
        }
    }
}
