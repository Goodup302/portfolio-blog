<?php

namespace app\Form;
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

    public function __construct($post) {parent::__construct($post); $this->hasLabel = true;}

    public function createUser() {

    }

    public function generateRandomID($length = 128) {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$-_.+!*()";
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}