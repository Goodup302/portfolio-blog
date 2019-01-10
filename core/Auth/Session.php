<?php

namespace Core\Auth;

class Session
{
    /**
     * @return bool
     */
    public static function isLogged()
    {
        return isset($_SESSION['auth']);
    }

    /**
     * @return bool
     */
    public static function getUserId()
    {
        if (self::isLogged()) {
            return $_SESSION['auth'];
        }
        return false;
    }

    /**
     * @param $id
     */
    public static function setSessionId($id)
    {
        $_SESSION['auth'] = $id;
    }

    /**
     * Log out user
     */
    public static function signOut()
    {
        $_SESSION['auth'] = null;
    }
}
