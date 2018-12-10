<?php

namespace App\Controller;

use Core\Auth\DBAuth;
use Core\HTML\Alert;
use Core\HTML\BootstrapStyle;

class UserController extends AppController
{
    public function auth() {
        $auth = new DBAuth(\App::getInstance()->getDatabase());
        $status = false;
        if (!empty($_GET['disconnect']) && $_GET['disconnect'] && $auth->isLogged()) {
            $auth->signOut();
            $alert = new Alert('Vous venez de vous déconnecter', BootstrapStyle::info);
        } else {
            if ($auth->isLogged()) {
                $status = true;
            } else {
                $alert = new Alert('Veuillez entrer les informations suivantes pour vous connécter', BootstrapStyle::info);
                if (!empty($_POST)) {
                    $status = $auth->login($_POST['login'], $_POST['password']);
                    if ($status !== true) {
                        $alert = new Alert($status, BootstrapStyle::warning);
                    }
                }
            }

            if ($status === true) {
                (new \App\Controller\Admin\AppController())->home();
                return;
            }

        }
        $this->twigRender('users/auth', compact('alert'));
    }
}