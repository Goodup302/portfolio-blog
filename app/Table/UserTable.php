<?php

namespace App\Table;
use Core\Table\Table;

class UserTable extends Table
{
    public function getUserByKey($key) {
        return $this->db->query(
            "SELECT * FROM {$this->table} WHERE validatekey = ?",
            $this->getEntityName(),
            [$key],
            true
        );
    }
}