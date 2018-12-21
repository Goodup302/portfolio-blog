<?php

namespace App\Form\AuthForm;
use Core\Auth\Session;
use Core\Form\PostForm;
use Core\Form\InputType;

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

    public function register()
    {
        $account = $auth->register(
            $this->get('username'),
            $this->get('login'),
            $this->get('password'),
            $this->get('email')
        );
        if ($account) {
            $auth->sendMail();
        } else {
            $this->setError('Une erreur inconnue est survenue lors de la création du compte');
        }
    }
}
