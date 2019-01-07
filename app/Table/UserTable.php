<?php

namespace App\Table;
use Core\Table\Table;

class UserTable extends Table
{
    use DBinjection;

    public function getUserByKey($key)
    {
        return $this->db->query(
            "SELECT * FROM {$this->table} WHERE validatekey = ?",
            $this->getEntityName(),
            [$key],
            true
        );
    }

    public function auth($login, $password = null)
    {
        if (is_null($password)) {
            return $this->db->query(
                "SELECT * FROM {$this->table} where binary login = ?",
                $this->getEntityName(),
                [$login],
                true
            );
        } else {
            return $this->db->query(
                "SELECT * FROM {$this->table} where binary login = ? and binary password = ?",
                $this->getEntityName(),
                array($login, $password),
                true
            );
        }

    }

    public function register($username, $login, $password, $email)
    {
        $userTable = new self();
        $args = array(
            'username' => $username,
            'login' => $login,
            'password' => $this->hashPassword($password),
            'email' => $email,
            'validatekey' => self::randomKey()
        );
        $user = $userTable->insert($args);
        if ($user) {
            return $userTable->getById($userTable->getLastId());
        } else {
            return false;
        }
    }

    public function usernameExist($username)
    {
        return $this->db->query(
            "SELECT * FROM {$this->table} where binary username = ?",
            null,
            [$username],
            true,
            false
        );
    }

    public function loginExist($login)
    {
        return $this->db->query(
            "SELECT * FROM {$this->table} where binary login = ?",
            null,
            [$login],
            true,
            false
        );
    }

    public function emailExist($email)
    {
        return $this->db->query(
            "SELECT * FROM {$this->table} where binary email = ?",
            null,
            [$email],
            true,
            false
        );
    }

    public static function randomKey($length = 128)
    {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$-_.+!*()";
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
}
