<?php

namespace App\UserAccount;

use App\Table\UserTable;
use Core\DataBase;

class UserAccount
{
    private $db;
    public function __construct(DataBase $database)
    {
        $this->db = $database;
    }

    public static function

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

    public function login($login, $password)
    {
        $usertable = new UserTable($this->db);
        $user = $usertable->auth($login, $password);
        if ($user) {
            if (boolval($user->validate) === true) {
                $this->setSessionId($user->id);
                return true;
            } else {
                return 'Veuillez valider votre compte';
            }
        }
        return 'Les informations rentrées ne sont pas correct';
    }

    public static function create($username, $login, $password, $email)
    {
        $userTable = new UserTable($this->db);
        $args = array(
            'username' => $username,
            'login' => $login,
            'password' => $password,
            'email' => $email,
            'validekey' => Account::generateRandomID()
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
            'validekey' => Account::generateRandomID()
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
