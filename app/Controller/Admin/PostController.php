<?php

namespace App\Controller\Admin;

use \Core\Auth\DBAuth;
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
    }


    public function loop() {
        $this->setTitle('Tous les articles');
        $posts = $this->Post->getAll();
        $this->twigRender('admin/posts/index', compact('posts'));
    }

    public function delete() {
        $auth = new DBAuth(App::getInstance()->getDatabase());
        if (!empty($_POST['id'])) {
            $postTable = $this->Post;
            $post = $postTable->getById($_POST['id']);
            if ($this->user->canEditPost($post)) {
                $this->Comment->deleteByPostId($_POST['id']);
                $postTable->delete($_POST['id']);
            }
        }
        $this->loop();
    }


    public function add() {
        $this->setTitle('Ajouter un article');
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
        $this->twigRender('admin/posts/add');
    }



    public function edit($id = null) {
        $this->setTitle('Editer un article');
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
                    $post = $postTable->getById($id);
                    $commentsnumber = $this->Comment->getComments($post->id, null, false);
                    $this->twigRender('admin/posts/edit', compact('post', 'commentsnumber'));
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