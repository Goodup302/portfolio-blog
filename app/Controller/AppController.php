<?php

namespace App\Controller;


use Core\Controller\Controller;

class AppController extends Controller
{
    protected $template = 'default';

    public function __construct()
    {
        $this->viewPath = ROOT . '/app/views/';
        var_dump($this->viewPath);
    }
}