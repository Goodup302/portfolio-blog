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
                $this->setSessionId($user->id);
                return true;
            } else {
                return 'Veuillez valider votre compte';
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

    public function setSessionId($id) {
        $_SESSION['auth'] = $id;
    }
    public function signOut() {
        $_SESSION['auth'] = null;
    }
}