<?php

namespace App\Controller;


class PostController extends AppController
{
    protected $viewPath;

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
        $this->render('posts/loop', compact('posts'));
    }
    public function single() {
        if (!empty($_GET['id'])) {
            $post = $this->Post->getById($_GET['id']);
            if ($post) {
                $this->setTitle('posts: '.$post->title);
                $author = $this->User->getById($post->getAuthorId());
                $comments = $this->Comment->getComments($_GET['id'], false);
                $excerpt = $post->getExcerpt(true);
                $this->render('posts/single', compact('post', 'author', 'comments', 'excerpt'));
            } else {
                // $app->error404("Cette posts n'existe pas !");
            }
        } else {
            //$app->error404("Aucun posts selectionné !");
        }
    }


    public function error404() {
        $this->title = 'Page introuvable';
        if (isset($_GET['error']) && $_GET['error'] != null) {
            $error = $_GET['error'];
        } else {
            $error = Config::getInstance(CONFIG_FILE)->get('page_not_found');
        }
        $this->render('errors/404', compact('error'));
    }
    public function auth() {
        $this->title = 'Accueil';
        $this->render('home', compact('app'));
    }
}