<?php

namespace App\Controller;

use App\Entity\UserEntity;
use App\Form\AuthForm\LoginForm;
use App\Form\AuthForm\RegisterForm;
use App\Table\UserTable;
use Core\Auth\Session;
use Core\HTML\Alert;
use Core\HTML\BootstrapStyle;

class UserController extends AppController
{

    const ACCOUNT_ALREADY_ACTIVATE = "Votre compte a déjà été activé";
    const ACCCOUNT_ACTIVATION = "Votre compte vient d'ètre activé";

    /**
     * Authentication management
     */
    public function auth()
    {
        if (!empty($_GET['action'])) {
            $action = $_GET['action'];
            if ($action === 'logout') {
                Session::signOut();
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
                    if (Session::isLogged()) {
                        $this->logged_user = (new UserTable())->getById(Session::getUserId());
                    }
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
            if ($user instanceof UserEntity && $user->validatekey === $_GET['key']) {
                if ($user->validate == 0) {
                    $this->userTable->update($user->id, array("validate" => 1));
                    $alert = new Alert(self::ACCCOUNT_ACTIVATION, BootstrapStyle::success);
                } else {
                    $alert = new Alert(self::ACCOUNT_ALREADY_ACTIVATE, BootstrapStyle::secondary);
                }
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
        if (Session::isLogged()) {
            $this->setTitle('Mon compte');
            $this->twigRender('users/account', compact('alert'));
        } else {
            $this->goToLogin();
        }
    }

    /**
     * Login Page
     */
    private function goToLogin()
    {
        header("location: index.php?p=auth&action=login");
    }
}
