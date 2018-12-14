<?php

namespace App\Controller;
use App\Form\CommentForm;
use Core\Auth\DBAuth;
use \App;

class PostController extends AppController
{
    protected $viewPath;

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Comment');
    }


    public function loop() {
        $this->setTitle('Tous les articles');
        $posts = $this->Post->getAll();
        $this->twigRender('posts/loop', compact('posts'));
    }


    public function single() {
        if (!empty($_GET['id'])) {
            $post = $this->Post->getById($_GET['id']);
            if ($post) {
                //Comment Form
                $commentform = new CommentForm($_POST);
                if ($commentform->isPost()) {
                    $auth = new DBAuth(App::getInstance()->getDatabase());
                    if ($commentform->fieldsIsValid() && $auth->isLogged()) {
                        $args = array(
                            "post_id" => $post->id,
                            "user_id" => $auth->getUserId(),
                            "content" => $commentform->getComment()
                        );
                        $this->Comment->insert($args);
                        header("location:index.php?p=admin_comments&id=".$post->id);
                    }
                }
                //
                $this->setTitle('Article - '.$post->title);
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