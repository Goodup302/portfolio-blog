<?php

namespace Core\Controller;

use Core\Auth\Session;
use Twig_Extension_Debug;
use Twig_Function;

class Controller
{
    protected $viewPath;
    protected $template;
    protected $componentPath;
    protected $tempFolder;
    private $title;
    private $prefixTitle;
    protected $logged_user;

    private $loader;
    private $twig;

    protected function twigRender($view, $args = [])
    {
        if (empty($this->loader)) {
            $this->loader = new \Twig_Loader_Filesystem($this->viewPath);
            $this->twig = new \Twig_Environment($this->loader, array(
                'cache' => false, // $this->viewPath . $this->tempFolder,
                'debug' => true
            ));
            $this->twig->addExtension(new Twig_Extension_Debug());
        }
        //Args
        $args['title'] = "{$this->prefixTitle} | {$this->title}";
        $args['template'] = "templates/{$this->template}.twig";
        $args['logged'] = Session::isLogged();
        if ($args['logged']) {
            $args['logged_user'] = $this->logged_user;
        }
        $args['component'] = $this->componentPath;
        //Function
        $this->twig->addFunction(
            new Twig_Function('currentPage', function ($name) {
                if ($_GET['p'] === $name) {
                    echo 'current';
                }
            })
        );
        echo $this->twig->render("$view.twig", $args);
    }

    protected function setPrefixTitle($prefix)
    {
        $this->prefixTitle = $prefix;
    }

    protected function setTitle($title)
    {
        $this->title = $title;
    }

    protected function getFile($view)
    {
        return $this->viewPath . $view . '.php';
    }
}
