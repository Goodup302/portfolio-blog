<?php

namespace App\Table;
use Core\Table\Table;

class PostTable extends Table
{
    public function getByUserId($id){
        return $this->db->query(
            'SELECT * FROM ' . $this->table .' WHERE user_id = ?',
            $this->getEntityName(),
            [$id]
        );
    }
}