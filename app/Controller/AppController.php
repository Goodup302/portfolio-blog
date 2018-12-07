<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;

class AppController extends Controller
{
    protected $template = 'default';

    public function __construct()
    {
        $this->viewPath = ROOT . '/app/views/';
    }

    protected function loadModel($name) {
        $this->$name = App::getInstance()->getTable($name);
    }

    public function home() {
        $this->setTitle('Accueil');
        $this->render('home');
    }
}