<?php

namespace Core\Auth;

class Session {


    public function __construct()
    {
    }

    public function isLogged()
    {
        return isset($_SESSION['auth']);
    }

    public function getUserId()
    {
        if ($this->isLogged()) {
            return $_SESSION['auth'];
        }
        return false;
    }

    public function setSessionId($id)
    {
        $_SESSION['auth'] = $id;
    }

    public function signOut()
    {
        $_SESSION['auth'] = null;
    }
}
