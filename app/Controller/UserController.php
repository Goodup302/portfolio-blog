<?php

namespace App\Controller;

use Core\Auth\DBAuth;
use Core\HTML\Alert;
use Core\HTML\BootstrapStyle;
use \app;
use Core\HTML\Form;

class UserController extends AppController
{
    public function auth() {
        $auth = new DBAuth(App::getInstance()->getDatabase());
        if (!empty($_GET['disconnect']) && $_GET['disconnect'] && $auth->isLogged()) {
            $auth->signOut();
            $alert = new Alert('Vous venez de vous déconnecter', BootstrapStyle::info);
        } else {
            $adminController = new \App\Controller\Admin\AppController();
            if ($auth->isLogged()) {
                $adminController->home();
            }

            $alert = new Alert('Veuillez entrer les informations suivantes pour vous connécter', BootstrapStyle::info);
            if (!empty($_POST)) {
                $status = $auth->login($_POST['login'], $_POST['password']);
                if ($status === true) {
                    $adminController->home();
                } else {
                    $alert = new Alert($status, BootstrapStyle::warning);
                }
            }
        }
        $form = new Form($_POST);
        $this->render('users/auth', compact('form', 'auth', 'alert'));
    }
}