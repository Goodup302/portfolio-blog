<?php

namespace Core\Controller;

class Controller
{
    protected $viewPath;
    protected $template;

    public function render($view, $args = []) {
        ob_start();
        extract($args);
        require_once $this->viewPath . $view . '.php';
        $content = ob_get_clean();
        require_once( $this->viewPath . 'templates/'. $this->template . '.php');
    }
}