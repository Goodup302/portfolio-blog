<?php

namespace App\UserAccount;

use App\Table\UserTable;
use Core\Auth\Session;

class UserAccount
{
    private $session;
    public function __construct()
    {
        $this->session = new Session();
    }

    public static function generateRandomID($length = 128)
    {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$-_.+!*()";
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function create($username, $login, $password, $email)
    {
        $userTable = new UserTable();
        $args = array(
            'username' => $username,
            'login' => $login,
            'password' => $password,
            'email' => $email,
            'validekey' => self::generateRandomID()
        );
        $user = $userTable->insert($args);
        var_dump($user);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function sendMail($username, $login, $password, $email)
    {
        $userTable = new UserTable($this->db);
        $args = array(
            'username' => $username,
            'login' => $login,
            'password' => $password,
            'email' => $email,
            'validekey' => self::generateRandomID()
        );
        $user = $userTable->insert($args);
        var_dump($user);
        if ($user) {
            return true;
        } else {
            return false;
        }
    }
}
