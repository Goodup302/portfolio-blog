<?php
/**
 * Created by PhpStorm.
 * UserTable: PC-PRO
 * Date: 19/11/2018
 * Time: 11:59
 */

namespace Core\Table;

class Table
{
    protected $table;
    protected $db;

    public function __construct(\App\DataBase $db = null)
    {
        $this->db = $db;
        if (is_null($this->table)) {
            $array = explode('\\', get_class($this));
            $class_name = end($array);
            //
            $this->table = strtolower(str_replace('Table', '', $class_name));
        }
    }

    public function getAll(){
        return $this->db->query('SELECT * FROM ' . $this->table, get_class($this));
    }
    public function getById($id){
        return $this->db->prepare('SELECT * FROM ' . $this->table .' WHERE id = ?', get_class($this), [$id], true);
    }
}