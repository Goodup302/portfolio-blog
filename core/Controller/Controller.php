<?php

namespace Core\Controller;
use Core\Auth\DBAuth;
use Twig_Extension_Debug;

class Controller
{
    protected $viewPath;
    protected $template;
    protected $componentPath;
    protected $tempFolder;
    protected $title;
    protected $auth;

    private $loader;
    private $twig;

    protected function twigRender($view, $args = []) {
        if (empty($this->loader)) {
            $this->loader = new \Twig_Loader_Filesystem($this->viewPath);
            $this->twig = new \Twig_Environment($this->loader, array(
                'cache' => false, // $this->viewPath . $this->tempFolder,
                'debug' => true
            ));
            $this->twig->addExtension(new Twig_Extension_Debug());
        }
        $args['title'] = $this->title;
        $args['template'] = 'templates/'. $this->template . '.twig';
        $args['logged'] = $this->auth->isLogged();
        $args['component'] = $this->componentPath;
        echo $this->twig->render($view.'.twig', $args);
    }

    protected function setTitle($title) {
        $this->title = $title;
    }

    protected function getFile($view) {
        return $this->viewPath . $view . '.php';
    }
}