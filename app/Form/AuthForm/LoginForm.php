<?php

namespace App\Form\AuthForm;
use Core\Auth\Session;
use Core\Form\PostForm;
use Core\Form\InputType;

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

    public function login($auth)
    {
        $status = false;
        if ($auth->isLogged()) {
            $status = true;
        } else {
            $status = $auth->login($_POST['login'], $_POST['password']);
            if ($status !== true) {
                $this->setError($status);
            }
        }
        if ($status === true) {
            header("location: index.php?p=admin");
            return;
        }
    }
}
