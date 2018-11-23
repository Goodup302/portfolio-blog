<?php

namespace App;


class App
{
    private $database;
    private $title;
    private $config;


    private static $_instance;
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {

        $this->config = Config::getInstance();
        $this->title = $this->config->get('default_title');
    }

    public function getDatabase() {
        if (is_null($this->database)) {
            $this->database = new DataBase(
                $this->config->get('db_name'),
                $this->config->get('db_host'),
                $this->config->get('db_user'),
                $this->config->get('db_pass')
            );
        }
        return $this->database;
    }

    public function error404($message = 'none') {
        $this->config->get('default_title');
        header("HTTP/1.0 404 Not Found");
        header("location:index.php?p=404&error=".$message);
    }

    public function getTitle() {
        return $this->title;
    }
    public function setTitle($title) {
        $this->title = $title;
    }
}