<?php
/**
 * Created by PhpStorm.
 * User: PC-PRO
 * Date: 23/11/2018
 * Time: 09:09
 */

namespace App;


class Config
{
    private $settings = array();
    private static $_instance;

    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->settings = require_once('../config.php');
    }
    public function get($key)
    {
        if (isset($this->settings[$key])) {
            return null;
        }
        return $this->settings[$key];
    }
}