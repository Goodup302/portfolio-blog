<?php

namespace App\Controller\Admin;


class PostController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Comment');
        $this->loadModel('User');
    }


    public function loop() {
        $this->setTitle('Tous les articles');
        $posts = $this->Post->getAll();
        $this->render('admin/posts/index', compact('posts'));
    }
}