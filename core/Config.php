<?php

namespace Core;


class Config
{
    private $settings = array();
    private static $instance;

    /**
     * Get config file
     *
     * @param $file
     * @return Config
     */
    public static function getInstance($file)
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($file);
        }
        return self::$instance;
    }

    /**
     * Config constructor.
     * @param $file
     */
    public function __construct($file)
    {
        $this->settings = require_once $file;
    }

    /**
     * Get an option value
     *
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}
