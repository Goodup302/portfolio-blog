<?php

namespace App\Table;
use Core\Table\Table;

class UserTable extends Table
{
    use DBinjection;

    /**
     * @param $key
     * @return array|int|mixed
     */
    public function getUserByKey($key)
    {
        return $this->db->query(
            "SELECT * FROM {$this->table} WHERE validatekey = ?",
            $this->getEntityName(),
            [$key],
            true
        );
    }

    /**
     * Login function
     *
     * @param $login
     * @param null $password
     * @return array|int|mixed
     */
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

    /**
     * @param $username
     * @param $login
     * @param $password
     * @param $email
     * @param bool $forceValidation
     * @param bool $forceAdmin
     * @return array|bool|int|mixed
     */
    public function register($username, $login, $password, $email, $forceValidation = false, $forceAdmin = false)
    {
        $userTable = new self();
        $args = array(
            'username' => $username,
            'login' => $login,
            'password' => $this->hashPassword($password),
            'email' => $email,
            'validatekey' => self::randomKey(),
            'validate' => intval($forceValidation),
            'admin' => intval($forceAdmin)
        );
        $user = $userTable->insert($args);
        if ($user) {
            return $userTable->getById($userTable->getLastId());
        } else {
            return false;
        }
    }

    /**
     * @param $username
     * @return array|int|mixed
     */
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

    /**
     * @param $login
     * @return array|int|mixed
     */
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

    /**
     * @param $email
     * @return array|int|mixed
     */
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

    /**
     * @param int $length
     * @return string
     */
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

    /**
     * @param $password
     * @return bool|string
     */
    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
    }
}
