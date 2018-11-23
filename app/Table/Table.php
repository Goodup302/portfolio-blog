<?php
/**
 * Created by PhpStorm.
 * UserTable: PC-PRO
 * Date: 19/11/2018
 * Time: 11:59
 */

namespace App\Table;
use App\App;

class Table
{
    protected $table;

    public function __construct()
    {
        if (is_null($this->table)) {
            $array = explode('\\', get_class($this));
            $class_name = end($array);
            //
            $this->table = strtolower(str_replace('Table', '', $class_name));
        }
    }

    public function getAll(){
        return App::getInstance()->getDatabase()->query('SELECT * FROM ' . $this->table, get_class($this));
    }
    public function getById($id){
        return App::getInstance()->getDatabase()->prepare('SELECT * FROM ' . $this->table .' WHERE id = ?', get_class($this), [$id], true);
    }
}