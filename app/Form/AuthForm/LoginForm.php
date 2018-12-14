<?php

namespace App\Form\AuthForm;
use Core\Form\PostForm;
use Core\Form\InputType;
use Core\Config;
use Core\Form\Email;
use App\Form\AuthForm\ConfirmForm;
use App\Form\AuthForm\RegisterForm;
use Core\Auth\DBAuth;
use Core\HTML\Alert;
use Core\HTML\BootstrapStyle;

class LoginForm extends PostForm
{
    protected $submitName = "Se connecter";
    protected $success_message = 'Connection effectuée avec success';
    protected $hasLabel = true;
    protected $inputModel = array(
        'login' => ['Pseudo', InputType::TEXT],
        'password' => ['Mot de passe', InputType::PASSWORD]
    );

    public function __construct($post) {parent::__construct($post);}

    public function login() {
        $auth = new DBAuth(\App::getInstance()->getDatabase());
        $status = false;
        if ($auth->isLogged()) {
            $status = true;
        } else {
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
    }
}