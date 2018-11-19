<?php
/**
 * Created by PhpStorm.
 * User: PC-PRO
 * Date: 19/11/2018
 * Time: 11:59
 */

namespace App\Table;
use App\App;

class Table
{
    protected static $table;

    private static function getTable(){
        if (static::$table == null) {
            $class_name = explode('\\', get_call_calss());
            static::$table = strtolower(end($class_name));
        } else {

        }
        return static::$table;
    }

    public static function getAll(){
        return App::getDatabase()->query('SELECT * FROM ' . static::getTable(), get_called_class());
    }
    public static function getById($id){
        return App::getDatabase()->prepare('SELECT * FROM ' . static::getTable() .' WHERE id = ?', get_called_class(), [$id], true);
    }
}