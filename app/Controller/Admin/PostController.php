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
        header('location:admin.php');
    }


    public function add() {
        $auth = new DBAuth(App::getInstance()->getDatabase());

        //Update Post
        if (isset($_POST) && $_POST != null) {
            $postTable = App::getInstance()->getTable('Post');
            if (!$postTable->titleExist($_POST['title'])) {
                $args = array(
                    "user_id" => $auth->getUserId(),
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

        $this->render('admin/posts/edit', compact('posts', 'form', 'user', 'auth'));
    }
}