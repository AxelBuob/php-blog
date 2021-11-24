<?php

namespace App;

use Core\Database\MysqlDatabase;
use Core\Config;
use Exception;

class Factory
{
    private static $_factory;
    private $db;

    public static function getFactory()
    {
        if(self::$_factory === null)
        {
            self::$_factory = new Factory;
        }
        return self::$_factory;
    }

    public static function autoloading()
    {
        if(session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        require ROOT . '/src/app/Autoloader.php';
        \App\Autoloader::register();
        require ROOT . '/src/core/Autoloader.php';
        \Core\Autoloader::register();
    }

    public function getDB()
    {
        $config = Config::getConfig(ROOT . '/config/config.php');
        if ($this->db === null) {
            $this->db = new MysqlDatabase($config->get('db_name'), $config->get('db_host'), $config->get('db_user'), $config->get('db_pass'));
        }
        return $this->db;
    }
}
