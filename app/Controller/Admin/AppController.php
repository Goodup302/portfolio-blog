<?php

namespace App\Controller\Admin;
use Core\Auth\Session;
use App\Entity\UserEntity;

/**
 * @property  UserEntity
 */
class AppController extends \App\Controller\AppController
{
    protected $user;

    /**
     * AppController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setPrefixTitle('Administration');
        if (Session::isLogged() === true) {
            $this->user = $this->userTable->getById(Session::getUserId());
            if ($this->user->admin) {
                return;
            }
        }
        $this->errorAuth();
    }

    /**
     * Redirect to home page
     */
    public function errorAuth()
    {
        header("HTTP/1.0 403 Forbidden");
        header("location:index.php");
    }
}
