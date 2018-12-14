<?php
namespace App\Form\AuthForm;
use Core\Form\PostForm;
use Core\Form\InputType;

class ConfirmForm extends PostForm
{
    protected $submitName = "Renvoyer le mail de confirmation";
    protected $success_message = 'Le mail de confirmation a été envoyé';
    protected $hasLabel = true;
    protected $inputModel = array(
        'email' => ['Email', InputType::EMAIL]
    );
    public function __construct($post) {parent::__construct($post); $this->hasLabel = true;}

    public function sendConfirm() {

    }
}