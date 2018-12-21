<?php

namespace App\Form;

use Core\Form\InputType;
use Core\Form\PostForm;

class AccountForm extends PostForm
{
    protected $submitName = "Modifier";
    protected $success_message = 'Votre compte à été mis à jour';
    protected $hasLabel = true;
    protected $inputModel = array(
        'username' => ['Nom et Prenom', InputType::TEXT],
        'email' => ['Email', InputType::EMAIL],
        'password' => ['Mot de passe', InputType::PASSWORD]
    );
}