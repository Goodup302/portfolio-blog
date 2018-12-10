<?php

namespace App\Controller\Admin;
use \App;
use Core\Auth\DBAuth;
use Core\Config;
use Core\HTML\Button;

class AppController extends \App\Controller\AppController
{
    protected $user;

    public function __construct()
    {
        $this->loadModel('User');
        parent::__construct();
        $auth = new DBAuth(App::getInstance()->getDatabase());
        if (!$auth->isLogged()) {
            $this->errorAuth();
        } else {
            $this->user = $this->User->getById($auth->getUserId());
        }

    }

    public function home() {
        $this->setTitle('Accueil Administration');
        $this->twigRender('admin/index');
    }

    public function errorAuth($message = null) {
        if (is_null($message)) {
            $message = Config::getInstance(CONFIG_FILE)->get('default_title');
        }
        header("HTTP/1.0 403 Forbidden");
        header("location:index.php");
    }
}