<?php

namespace App\Controller\Admin;

use \Core\Auth\DBAuth;
use \Core\HTML\Form;
use \App;
use \Core\HTML\Alert;
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
        $auth = new DBAuth(App::getInstance()->getDatabase());
        $user = $this->User->getById($auth->getUserId());

        if (!empty($_POST['id'])) {
            $postTable = App::getInstance()->getTable('Post');
            $post = $postTable->getById($_POST['id']);
            if ($user->canEditPost($post)) {
                $postTable->delete($_POST['id']);
            }
        }
        header('location:index.php?p=admin_posts');
    }


    public function add() {
        if (!empty($_POST)) {
            $postTable = $this->Post;
            if (!$postTable->titleExist($_POST['title'])) {
                $args = array(
                    "user_id" => $this->user->id,
                    "title" => $_POST['title'],
                    "excerpt" => $_POST['excerpt'],
                    "content" => $_POST['content'],
                    "image" => $_POST['image'],
                    "lastdate" => date('Y-m-d H:i:s')
                );
                $postTable->insert($args);
                header('location:?p=admin_posts_edit&id=' . App::getInstance()->getDatabase()->getLastId());
            } else {
                (new Alert("Cette article existe déjà", BootstrapStyle::danger))->show();
            }
        }
        $form = new Form($_POST);
        $this->render('admin/posts/add', compact('posts', 'form', 'user', 'auth'));
    }



    public function edit() {
        if (!empty($_GET['id'])) {
            $postTable = App::getInstance()->getTable('Post');
            if ($postTable->idExist($_GET['id'])) {
                $post = $postTable->getById($_GET['id']);
                if ($this->user->canEditPost($post)) {
                    if (!empty($_POST)) {
                        $args = array(
                            "title" => $_POST['title'],
                            "excerpt" => $_POST['excerpt'],
                            "content" => $_POST['content'],
                            "image" => $_POST['image'],
                            "lastdate" => date('Y-m-d H:i:s')
                        );
                        $postTable->update($_GET['id'], $args);
                    }
                    $form = new Form($_POST);
                    $post = $postTable->getById($_GET['id']);
                    $this->render('admin/posts/edit', compact('post', 'form'));
                } else {
                    (new Alert("Cette article ne vous appartient pas", BootstrapStyle::danger))->show();
                }
            } else {
                (new Alert("Cette article n'existe pas ou plus", BootstrapStyle::warning))->show();
            }
        } else {
            header('location:index.php?p=admin_posts');
        }
    }
}