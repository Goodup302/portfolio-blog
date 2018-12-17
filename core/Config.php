<?php

namespace Core;


class Config
{
    private $settings = array();
    private static $instance;

    public static function getInstance($file) {
        if (is_null(self::$instance)) {
            self::$instance = new self($file);
        }
        return self::$instance;
    }

    public function __construct($file)
    {
        $this->settings = require($file);
    }
    public function get($key)
    {
        if (!isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}