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

    public function insert($data){
        return $this->db->query(
            'SELECT * FROM ' . $this->table .' WHERE id = ?',
            $this->getEntityName(),
            [0],
            true,
            false
        );
    }

    public function update($id, $data){
        $sql_parts = [];
        $attributes = [];
        foreach ($data as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }
        $attributes[] = $id;
        $sql_parts = implode(', ', $sql_parts);

        echo 'UPDATE '.$this->table.' SET '.$sql_parts.' WHERE id = ?';
        var_dump($attributes);

        return $this->db->query(
            'UPDATE '.$this->table.' SET '.$sql_parts.' WHERE id = ?',
            null,
            $attributes,
            null,
            false
        );
    }

    public function delete($id){
        return $this->db->query(
            'SELECT * FROM ' . $this->table .' WHERE id = ?',
            $this->getEntityName(),
            [$id],
            true,
            false
        );
    }

    public function getEntityName() {
        return str_replace('Table', 'Entity', get_class($this));
    }
}