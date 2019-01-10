<?php

namespace App\Controller;

use Core\Controller\Controller;
use Core\Config;
use Core\Auth\Session;
use App\Form\ContactForm;
use App\Table\UserTable;
use App\Table\CommentTable;
use App\Table\PostTable;

class AppController extends Controller
{
    protected $template = 'default';
    protected $componentPath = 'component/';
    protected $tempFolder = 'temp';

    protected $userTable;
    protected $commentTable;
    protected $postTable;

    /**
     * AppController constructor.
     */
    public function __construct()
    {
        $this->userTable = new UserTable();
        $this->commentTable = new CommentTable();
        $this->postTable = new PostTable();

        $this->viewPath = ROOT . '/app/views/';
        $this->setPrefixTitle(Config::getInstance(CONFIG_FILE)->get('default_title'));
        if (Session::isLogged()) {
            $this->logged_user = $this->userTable->getById(Session::getUserId());
        }
    }

    /**
     * Home page controller
     */
    public function home()
    {
        $this->setTitle('Accueil');
        $contactform = new ContactForm($_POST);
        if ($contactform->isPost() && $contactform->fieldsIsValid()) {
            $contactform->sendMail();
        }
        $this->twigRender('home', compact('contactform'));
    }

    /**
     * Error 404 controller
     *
     * @param null $error
     */
    public function error404($error = null)
    {
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
