<?php

namespace App\Controller\Admin;

use \Core\HTML\Alert;
use \Core\HTML\BootstrapStyle;

class PostController extends AppController
{

    /**
     * Show all posts on admin panel
     */
    public function loop()
    {
        $this->setTitle('Tous les articles');
        $posts = $this->postTable->getAll();
        $this->twigRender('admin/posts/index', compact('posts'));
    }


    /**
     * Delete a post
     */
    public function delete()
    {
        if (!empty($_POST['id'])) {
            $postTable = $this->postTable;
            $post = $postTable->getById($_POST['id']);
            if ($this->user->canEditPost($post)) {
                $this->commentTable->deleteByPostId($_POST['id']);
                $postTable->delete($_POST['id']);
            }
        }
        $this->loop();
    }

    /**
     * Add a post
     */
    public function add()
    {
        $this->setTitle('Ajouter un article');
        if (!empty($_POST)) {
            $postTable = $this->postTable;
            $args = array(
                "user_id" => $this->user->id,
                "title" => $_POST['title'],
                "excerpt" => $_POST['excerpt'],
                "content" => $_POST['content'],
                "image" => $_POST['image'],
                "lastdate" => date('Y-m-d H:i:s')
            );
            $postTable->insert($args);
            header("location:index.php?p=admin_posts_edit&id={$postTable->getLastId()}");
        }
        $this->twigRender('admin/posts/add');
    }
    
    /**
     * Edit a post
     * 
     * @param null $id
     */
    public function edit($id = null)
    {
        $this->setTitle('Editer un article');
        if (is_null($id)) {
            $id = $_GET['id'];
        }
        if (!empty($id)) {
            $postTable = $this->postTable;
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
                    $commentsnumber = $this->commentTable->getComments($post->id, null, false);
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
