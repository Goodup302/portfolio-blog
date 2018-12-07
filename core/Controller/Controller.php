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
        require_once $this->viewPath . $view . '.php';
        $content = ob_get_clean();
        require_once( $this->viewPath . 'templates/'. $this->template . '.php');
    }

    protected function setTitle($title) {
        $this->title = $title;
    }
}