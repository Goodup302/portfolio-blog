<?php

namespace App\Controller\Admin;

use \Core\Auth\DBAuth;
use \Core\HTML\Form;
use \App;

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
        $auth = new DBAuth(App::getInstance()->getDatabase());
        $user = $this->User->getById($auth->getUserId());

        if ($user->admin) {
            $posts = $this->Post->getAll();
        } else {
            $posts = $this->Post->getByUserId($auth->getUserId());
        }
        $form = new Form();
        $app = App::getInstance();
        $this->render('admin/posts/index', compact('app', 'posts', 'form', 'user', 'auth'));
    }

    public function delete() {

        $this->render('admin/posts/index', compact('posts', 'form', 'user', 'auth'));
    }
    public function add() {

        $this->render('admin/posts/index', compact('posts', 'form', 'user', 'auth'));
    }
    public function edit() {

        $this->render('admin/posts/index', compact('posts', 'form', 'user', 'auth'));
    }
}