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

    public function test() {
       /* $this->setTitle('Accueil');
        $this->render('home');*/


        $loader = new \Twig_Loader_Filesystem($this->viewPath);
        $twig = new \Twig_Environment($loader, array(
            'cache' => false, // $this->viewPath . 'tmp'
        ));
        echo $twig->render('test.twig');
    }
}