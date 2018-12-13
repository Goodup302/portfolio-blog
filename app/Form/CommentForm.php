<?php

namespace App\Form;
use Core\Form\PostForm;
use Core\Form\InputType;

class CommentForm extends PostForm
{
     public function __construct($post)
     {
         parent::__construct($post);
         $this->inputModel = array(
             'username' => ['Nom et Prenom', InputType::TEXT],
             'email' => ['Email', InputType::EMAIL],
             'message' => ['Message', InputType::TEXTAREA]
         );
         $this->submitName = 'Envoyer';
         $this->success_message = 'Votre commentaire a été envoyer';
     }
}