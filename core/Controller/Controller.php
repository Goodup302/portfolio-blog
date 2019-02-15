<?php

namespace Core\Controller;

use App\Entity\UserEntity;
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
    /**
     * @var UserEntity
     */
    protected $logged_user;

    private $loader;
    private $twig;

    /**
     * Render an html twig page
     *
     * @param $view
     * @param array $args
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
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
                    echo ' current ';
                }
            })
        );
        $this->twig->addFunction(
            new Twig_Function('currentPagePrefix', function ($prefix) {
                echo substr($_GET['p'], 0, strlen($prefix));
                if (substr($_GET['p'], 0, strlen($prefix)) === $prefix) {
                    echo ' current ';
                }
            })
        );
        echo $this->twig->render("$view.twig", $args);
    }

    /**
     * @param $prefix
     */
    protected function setPrefixTitle($prefix)
    {
        $this->prefixTitle = $prefix;
    }

    /**
     * @param $title
     */
    protected function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get a twig view file
     *
     * @param $view
     * @return string
     */
    protected function getFile($view)
    {
        return $this->viewPath . $view . '.php';
    }
}
