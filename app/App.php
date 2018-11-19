<?php

namespace App;


class App
{
    const DB_NAME = 'blog';
    const DB_USER = 'root';
    const DB_PASS = 'root';
    const DB_HOST = '127.0.0.1';

    const EXCERPT_LENGTH = 100;


    private  static $database;

    public static function getDatabase() {
        if (self::$database == null) {
            self::$database = new DataBase(self::DB_NAME, self::DB_HOST, self::DB_USER, self::DB_PASS);
        }
        return self::$database;
    }
}