<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;
use Core\Config;
use Core\Auth\DBAuth;
use App\Form\ContactForm;

class AppController extends Controller
{
    protected $template = 'default';
    protected $componentPath = 'component/';
    protected $tempFolder = 'temp';

    public function __construct()
    {
        $this->loadModel('User');
        $this->viewPath = ROOT . '/app/views/';
        $this->setPrefixTitle(Config::getInstance(CONFIG_FILE)->get('default_title'));
        $this->auth = new DBAuth(App::getInstance()->getDatabase());
        if ($this->auth->isLogged()) {
            $this->logged_user = $this->User->getById($this->auth->getUserId());
        }

    }

    protected function loadModel($name) {
        $this->$name = App::getInstance()->getTable($name);
    }

    public function home() {
        $this->setTitle('Accueil');
        $contactform = new ContactForm($_POST);
        if ($contactform->isPost() && $contactform->fieldsIsValid()) {
            $contactform->sendMail();
        }
        $this->twigRender('home', compact('contactform'));
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
        header("HTTP/1.0 404 Not Found");
        $this->twigRender('errors/404', compact('error'));
    }
}