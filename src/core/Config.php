<?php

namespace Core;

/**
 * Class used to load the configuration of the database
 */
class Config
{
    /**
     * Database connection information
     *
     * @var array
     */
    private $settings = [];

    /** Object that contain database login information
     * 
     *
     * @var [object]
     */
    private static $_instance;

    /**
     * Save Database connection information in an array
     */
    public function __construct($file)
    {
        $this->settings = require $file;
    }

    /**
     * Singleton - Create an instance if doesn't exist
     *
     * @return object
     */
    public static function getConfig($file)
    {
        if (self::$_instance === null) {
            self::$_instance = new Config($file);
        }
        return self::$_instance;
    }

    /**
     * Return a key of  the array settings
     *
     * @param [string] $key
     * @return string
     */
    public function get($key)
    {
        if(!isset($this->settings[$key]))
        {
            return null;
        }
        return $this->settings[$key];
    }
}
