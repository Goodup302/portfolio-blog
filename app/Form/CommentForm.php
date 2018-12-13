<?php

namespace App\Form;
use Core\Form\PostForm;
use Core\Form\InputType;

class CommentForm extends PostForm
{
    protected $submitName = 'Envoyer';
    protected $success_message = 'Votre commentaire a été envoyé';
    protected $inputModel = array(
        'message' => ['Message', InputType::TEXTAREA]
    );

    public function __construct($post) {parent::__construct($post);}

    public function getComment() {
        return $this->data['message'];
    }
}