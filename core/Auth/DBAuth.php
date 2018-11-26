<?php

namespace Core\Auth;


use Core\DataBase;

class DBAuth {
    private $db;
    public function __construct(DataBase $db)
    {
        $this->db = $db;
    }

    public function login($login, $password) {
        $user = $this->db->query(
            'SELECT * FROM user where binary login = ? and binary password = ?',
            null,
            array($login, $password),
            true
        );
        if ($user) {
            if ($user->validate === true) {
                $_SESSION['auth'] = $user->id;
                return true;
            } else {
                echo 'Veuillez valider votre compte (Renvoyer le mail de confirmation)';
            }
        }
        return false;
    }

    public function isLogged() {
        return isset($_SESSION['auth']);
    }

    public function getUserId() {
        if ($this->isLogged()) {
            return $_SESSION['auth'];
        }
        return false;
    }
}