<?php

namespace App\Controller\Admin;

use \Core\Auth\DBAuth;
use \Core\HTML\Form;
use \App;
use \Core\HTML\Alert;
use Core\HTML\Button;
use \Core\HTML\BootstrapStyle;

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

        $posts = $this->Post->getAll();
        $form = new Form();
        $app = App::getInstance();
        $this->render('admin/posts/index', compact('app', 'posts', 'form', 'user', 'auth'));
    }

    public function delete() {
        $auth = new DBAuth(App::getInstance()->getDatabase());
        $user = $this->User->getById($auth->getUserId());

        if (!empty($_POST['id'])) {
            $postTable = $this->Post;
            $post = $postTable->getById($_POST['id']);
            if ($user->canEditPost($post)) {
                $this->Comment->deleteByPostId($_POST['id']);
                $postTable->delete($_POST['id']);
            }
        }
        $this->loop();
    }


    public function add() {
        if (!empty($_POST)) {
            $postTable = $this->Post;
            $args = array(
                "user_id" => $this->user->id,
                "title" => $_POST['title'],
                "excerpt" => $_POST['excerpt'],
                "content" => $_POST['content'],
                "image" => $_POST['image'],
                "lastdate" => date('Y-m-d H:i:s')
            );
            $postTable->insert($args);
            header("location:index.php?p=admin_posts_edit&id=".$postTable->getLastId());
        }
        $form = new Form($_POST);
        $this->render('admin/posts/add', compact('posts', 'form', 'user', 'auth'));
    }



    public function edit($id = null) {
        if (is_null($id)) {
            $id = $_GET['id'];
        }
        if (!empty($id)) {
            $postTable = $this->Post;
            if ($postTable->idExist($id)) {
                $post = $postTable->getById($id);
                if ($this->user->canEditPost($post)) {
                    if (!empty($_POST)) {
                        $args = array(
                            "title" => $_POST['title'],
                            "excerpt" => $_POST['excerpt'],
                            "content" => $_POST['content'],
                            "image" => $_POST['image'],
                            "lastdate" => date('Y-m-d H:i:s')
                        );
                        $postTable->update($id, $args);
                    }
                    $form = new Form($_POST);
                    $post = $postTable->getById($id);
                    $commentsNumber = $this->Comment->getComments($post->id, null, false);
                    if ($commentsNumber > 0) {
                        $commentsButton = new Button('Commentaires liés à cet article ('.$commentsNumber.')','button', BootstrapStyle::secondary);
                        $commentsButton->setUrl("?p=admin_comments&id=$post->id");
                    }
                    $this->render('admin/posts/edit', compact('post', 'form', 'commentsButton'));
                } else {
                    (new Alert("Cette article ne vous appartient pas", BootstrapStyle::danger))->show();
                }
            } else {
                (new Alert("Cette article n'existe pas ou plus", BootstrapStyle::warning))->show();
            }
        } else {
            $this->loop();
        }
    }
}