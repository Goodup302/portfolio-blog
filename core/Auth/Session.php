<?php

namespace Core\Auth;

class Session
{
    public static function isLogged()
    {
        return isset($_SESSION['auth']);
    }

    public static function getUserId()
    {
        if (self::isLogged()) {
            return $_SESSION['auth'];
        }
        return false;
    }

    public static function setSessionId($id)
    {
        $_SESSION['auth'] = $id;
    }

    public static function signOut()
    {
        $_SESSION['auth'] = null;
    }
}
