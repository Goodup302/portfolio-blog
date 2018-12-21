<?php

namespace App\Table;
use App\Entity\UserEntity;
use Core\Table\Table;

class UserTable extends Table
{
    use DBinjection;

    public function getUserByKey($key) {
        return $this->db->query(
            "SELECT * FROM {$this->table} WHERE validatekey = ?",
            $this->getEntityName(),
            [$key],
            true
        );
    }

    public function auth($login, $password) : UserEntity {
        return $this->db->query(
            "SELECT * FROM user where binary login = ? and binary password = ?",
            $this->getEntityName(),
            array($login, $password),
            true
        );
    }
}