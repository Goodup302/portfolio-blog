<?php

namespace App\Controller;

use App\Entity\UserEntity;
use App\Form\AuthForm\LoginForm;
use App\Form\AuthForm\RegisterForm;
use Core\Auth\Session;
use Core\HTML\Alert;
use Core\HTML\BootstrapStyle;

class UserController extends AppController
{

    /**
     * Authentication management
     */
    public function auth()
    {
        $auth = new Session();
        if (!empty($_GET['action'])) {
            $action = $_GET['action'];
            if ($action === 'logout') {
                $auth->signOut();
                $this->goToLogin();
            } elseif ($action === 'register') {
                $this->setTitle("S'enregistrer");
                $form = new RegisterForm($_POST);
                if ($form->isValid()) {
                    $form->register();
                }
            } elseif ($action === 'login') {
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

    /**
     * User account activation
     */
    public function activate()
    {
        if (!empty($_GET['key'])) {
            $user = $this->userTable->getUserByKey($_GET['key']);
            if ($user instanceof UserEntity && $user->validate == 0 && $user->validatekey === $_GET['key']) {
                $this->userTable->update($user->id, array("validate" => 1));
                (new Session())->setSessionId($user->id);
                $alert = new Alert('Votre compte a été validé', BootstrapStyle::success);
            } else {
                $this->goToLogin();
            }
        } else {
            $this->goToLogin();
        }
        $this->twigRender('users/activate', compact('alert'));
    }

    /**
     * User account page
     */
    public function account()
    {
        $this->setTitle('Mon compte');
        $this->twigRender('users/account', compact('alert'));
    }

    /**
     * Login Page
     */
    private function goToLogin()
    {
        header("location: index.php?p=auth&action=login");
    }
}
