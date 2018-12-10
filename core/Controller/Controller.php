<?php

namespace Core\Controller;

class Controller
{
    protected $viewPath;
    protected $template;
    protected $title;

    protected function render($view, $args = []) {
        ob_start();
        extract($args);
        extract(['title' => $this->title]);
        require_once $this->getFile($view);
        $content = ob_get_clean();
        require_once( $this->viewPath . 'templates/'. $this->template . '.php');
    }

    public function twigRender($view, $args = []) {

        $loader = new \Twig_Loader_Filesystem($this->viewPath);
        $twig = new \Twig_Environment($loader, array(
            'cache' => false, // $this->viewPath . 'tmp'
            'debug' => true
        ));
        $twig->addGlobal('title', $this->title);
        $twig->addGlobal('template', 'templates/'. $this->template . '.twig');
        echo $twig->render($view.'.twig', $args);
    }

    protected function setTitle($title) {
        $this->title = $title;
    }

    protected function getFile($view) {
        return $this->viewPath . $view . '.php';
    }
}