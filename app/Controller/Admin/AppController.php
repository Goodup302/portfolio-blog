<?php

namespace App\Controller\Admin;
use \App;
use Core\Auth\DBAuth;
use Core\Config;

class AppController extends \App\Controller\AppController
{
    public function __construct()
    {
        parent::__construct();
        $auth = new DBAuth(App::getInstance()->getDatabase());
        if (!$auth->isLogged()) {
            $this->errorAuth();
        }
    }

    public function home() {
        $this->setTitle('Accueil Administration');
        $this->render('admin/index');
    }

    public function errorAuth($message = null) {
        if (is_null($message)) {
            $message = Config::getInstance(CONFIG_FILE)->get('default_title');
        }
        header("HTTP/1.0 403 Forbidden");
        header("location:index.php");
    }
}