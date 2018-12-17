<?php

namespace App\Controller;
use App\Entity\UserEntity;
use App\Form\AuthForm\LoginForm;
use App\Form\AuthForm\RegisterForm;
use Core\Auth\DBAuth;
use Core\HTML\Alert;
use Core\HTML\BootstrapStyle;

class UserController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
    }

    public function auth() {
        $auth = new DBAuth(\App::getInstance()->getDatabase());
        if (!empty($_GET['action'])) {
            $action = $_GET['action'];
            if ($auth->isLogged()) {
                $auth->signOut();
                header("location: index.php?p=auth&action=login");


            } else if ($action === 'register') {
                $this->setTitle("S'enregistrer");
                $form = new RegisterForm($_POST);
                if ($form->isValid()) {
                    $form->register();
                }

            } else if ($action === 'login'){
                $this->setTitle("Connection");
                $form = new LoginForm($_POST);
                if ($form->isValid()) {
                    $form->login();
                }
            } else {
                $this->goToLogin();
            }
            $this->twigRender('users/auth', compact('alert', 'action', 'form'));
            return;
        }
        $this->goToLogin();
    }


    public function activate() {
        if (!empty($_GET['key'])) {
            $user = $this->User->getUserByKey($_GET['key']);
            if ($user instanceof UserEntity && $user->validate == 0 && $user->validatekey === $_GET['key']) {
                /* Validation on BDD */
                $args = array("validate" => 1);
                $this->User->update($user->id, $args);
                $auth = new DBAuth(\App::getInstance()->getDatabase());
                /* Connection */
                $auth->setSessionId($user->id);
                $alert = new Alert('Votre compte a été validé', BootstrapStyle::success);
            }

            $this->twigRender('users/auth', compact('alert'));
        }
        $this->goToLogin();

    }

    public function account() {
        $this->setTitle('Mon compte');
        $this->twigRender('users/account', compact('alert'));
    }

    private function goToLogin() {
        header("location: index.php?p=auth&action=login");

    }
}