<?php

namespace App\Form;
use Core\Form\PostForm;
use Core\Form\InputType;
use Core\Config;
use Core\Form\Email;

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
}