<?php

namespace App\Controller;


class PostController extends AppController
{
    protected $viewPath;

    public function home() {
        \App::getInstance()->setTitle('Accueil');
        $this->render('home');
    }
}