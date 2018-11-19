<?php

namespace App;


class App
{
    const DB_NAME = 'blog';
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_HOST = '127.0.0.1';

    const EXCERPT_LENGTH = 100;
    const PAGE_NOT_FOUND = 'Error 404 Page !';


    private  static $database;

    public static function getDatabase() {
        if (self::$database == null) {
            self::$database = new DataBase(self::DB_NAME, self::DB_HOST, self::DB_USER, self::DB_PASS);
        }
        return self::$database;
    }

    public static function error404($message = self::PAGE_NOT_FOUND) {
        header("HTTP/1.0 404 Not Found");
        header("location:index.php?p=404&error=".$message);
    }
}