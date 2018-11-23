<?php

namespace Core\Table;
use \Core\DataBase;

class Table
{
    protected $table;
    protected $db;

    public function __construct(DataBase $db = null)
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
        return $this->db->query(
            'SELECT * FROM ' . $this->table,
            $this->getEntityName()
        );
    }
    public function getById($id){
        return $this->db->query(
            'SELECT * FROM ' . $this->table .' WHERE id = ?',
            $this->getEntityName(),
            [$id],
            true
        );
    }

    public function getEntityName() {
        return str_replace('Table', 'Entity', get_class($this));
    }
}