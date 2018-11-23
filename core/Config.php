<?php
/**
 * Created by PhpStorm.
 * UserTable: PC-PRO
 * Date: 23/11/2018
 * Time: 09:09
 */

namespace Core;


class Config
{
    private $settings = array();
    private static $_instance;

    public static function getInstance($file) {
        if (is_null(self::$_instance)) {
            self::$_instance = new self($file);
        }
        return self::$_instance;
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