<?php

namespace App\Controller;
use App\Form\CommentForm;

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
        $this->twigRender('posts/loop', compact('posts'));
    }


    public function single() {
        if (!empty($_GET['id'])) {
            $commentform = new CommentForm($_POST);
            if ($commentform->isPost()) {
                if ($commentform->isValid() == true) {
                    var_dump($commentform);
                }
            }
            $post = $this->Post->getById($_GET['id']);
            if ($post) {
                $this->setTitle('Article | '.$post->title);
                $author = $this->User->getById($post->getAuthorId());
                $comments = $this->Comment->getComments($_GET['id'], true);
                $commentsnumber = $this->Comment->getComments($_GET['id'], true, false);
                $this->twigRender('posts/single', compact('post', 'comments', 'commentsnumber', 'commentform'));
            } else {
                $this->error404("Cette article n'existe pas ou plus !");
            }
        } else {
            $this->error404("Aucun article selectionné !");
        }
    }
}