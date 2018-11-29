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
            if (boolval($user->validate) === true) {
                $_SESSION['auth'] = $user->id;
                return true;
            } else {
                return 'Veuillez valider votre compte (Renvoyer le mail de confirmation)';
            }
        }
        return 'Les informations rentrées ne sont pas correct';
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