<?php

namespace App\Form\AuthForm;
use Core\Form\PostForm;
use Core\Form\InputType;
use Core\Config;
use Core\Form\Email;

class RegisterForm extends PostForm
{
    protected $submitName = "S'enregistrer";
    protected $success_message = 'Votre demande a été envoyée';
    protected $hasLabel = true;
    protected $inputModel = array(
        'username' => ['Nom et Prenom', InputType::TEXT],
        'login' => ['Pseudo', InputType::TEXT],
        'email' => ['Email', InputType::EMAIL],
        'password' => ['Mot de passe', InputType::PASSWORD]
    );

    public function __construct($post) {parent::__construct($post);}

    public function register() {

    }
}