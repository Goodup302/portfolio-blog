<?php

namespace App;


class App
{
    private $database;
    private $title;


    private static $_instance;
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getTable($name) {
        $class_name = "App\\Table\\".ucfirst($name).'Table';
        return new $class_name;
    }

    public function __construct()
    {
        $this->title = Config::getInstance()->get('default_title');
    }

    public function getDatabase() {
        if (is_null($this->database)) {
            $config = Config::getInstance();
            $this->database = new DataBase(
                $config->get('db_name'),
                $config->get('db_host'),
                $config->get('db_user'),
                $config->get('db_pass')
            );
        }
        return $this->database;
    }

    public function error404($message = null) {
        if (is_null($message)) {
            $message = $this->config->get('default_title');
        }
        header("HTTP/1.0 404 Not Found");
        header("location:index.php?p=404&error=".$message);
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title . ' | ' . Config::getInstance()->get('default_title');
    }
}