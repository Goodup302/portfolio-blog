<?php

namespace Core\Controller;
use Twig_Extension_Debug;

class Controller
{
    protected $viewPath;
    protected $template;
    protected $componentPath;
    protected $title;

    private $loader;
    private $twig;

    protected function render($view, $args = []) {
        ob_start();
        extract($args);
        extract(['title' => $this->title]);
        require_once $this->getFile($view);
        $content = ob_get_clean();
        require_once( $this->viewPath . 'templates/'. $this->template . '.php');
    }

    protected function twigRender($view, $args = []) {
        if (empty($this->loader)) {
            $this->loader = new \Twig_Loader_Filesystem($this->viewPath);
            $this->twig = new \Twig_Environment($this->loader, array(
                'cache' => false, // $this->viewPath . 'temp'
                'debug' => true
            ));
            $this->twig->addExtension(new Twig_Extension_Debug());
        }
        $args['title'] = $this->title;
        $args['template'] = 'templates/'. $this->template . '.twig';
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