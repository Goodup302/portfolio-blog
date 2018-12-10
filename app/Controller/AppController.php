<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;
use Core\Config;

class AppController extends Controller
{
    protected $template = 'default';
    protected $componentPath = 'component/';

    public function __construct()
    {
        $this->viewPath = ROOT . '/app/views/';
        $this->setTitle(App::getInstance()->title);
    }

    protected function loadModel($name) {
        $this->$name = App::getInstance()->getTable($name);
    }

    public function home() {
        $this->setTitle('Accueil');
        $this->twigRender('home');
    }
    public function contact() {
        $this->setTitle('Contact');
        $this->twigRender('contact');
    }
    public function about() {
        $this->setTitle('À propos');
        $this->twigRender('about');
    }

    public function error404($error = null) {
        $this->setTitle('Page introuvable');
        if (empty($error)) {
            if (!empty($_GET['error'])) {
                $error = $_GET['error'];
            } else {
                $error = Config::getInstance(CONFIG_FILE)->get('page_not_found');
            }
        }
        $this->twigRender('errors/404', compact('error'));
    }
}