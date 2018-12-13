<?php
namespace App\Form;
use Core\Form\PostForm;
use Core\Form\InputType;
use Core\Config;

class ContactForm extends PostForm
{
    protected $submitName = 'Contacter';
    protected $success_message = 'Votre demande a été envoyée';
    protected $inputModel = array(
        'username' => ['Nom et Prenom', InputType::TEXT],
        'email' => ['Email', InputType::EMAIL],
        'message' => ['Message', InputType::TEXTAREA]
    );

    public function __construct($post) {parent::__construct($post);}

    public function sendMail() {

    }
}