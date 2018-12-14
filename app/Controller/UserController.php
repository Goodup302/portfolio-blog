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
        if (!empty($_GET['action'])) {
            $action = $_GET['action'];
            if ($action === 'logout' && $auth->isLogged()) {
                $auth->signOut();
                $alert = new Alert('Vous venez de vous déconnecter', BootstrapStyle::info);


            } else if ($action === 'register') {
                $alert = new Alert('Vous venez de vous register', BootstrapStyle::info);


            } else if ($action === 'login'){
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
                    header("location: index.php?p=admin");
                    return;
                }
            } else {
                header("location: index.php?p=auth&action=login");
            }
            $this->twigRender('users/auth', compact('alert', 'action'));
            return;
        }
        header("location: index.php?p=auth&action=login");
    }


    public function activate() {
        $auth = new DBAuth(\App::getInstance()->getDatabase());
        $args = array(
            "title" => $_POST['title'],
            "excerpt" => $_POST['excerpt'],
            "content" => $_POST['content'],
            "image" => $_POST['image'],
            "lastdate" => date('Y-m-d H:i:s')
        );
        $this->User->update($id, $args);
        $this->twigRender('users/auth', compact('alert'));
    }
}