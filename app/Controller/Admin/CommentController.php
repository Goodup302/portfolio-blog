<?php

namespace App\Controller\Admin;

class CommentController extends AppController
{
    /**
     * Show all comments on admin panel
     *
     * @param null $filterid
     */
    public function loop($filterid = null)
    {
        if (is_null($filterid) && !empty($_GET['id'])) {
            $filterid = $_GET['id'];
        }
        if (!empty($filterid)) {
            $comments = $this->commentTable->getComments($filterid);
            $returnurl = "index.php?p=admin_posts_edit&id=$filterid";
            $post = $this->postTable->getById($filterid);
            $this->setTitle("Commentaires de l'article $post->title");
        } else {
            $comments = $this->commentTable->getAll();
            $returnurl = 'index.php?p=admin_posts';
            $this->setTitle('Tous les commentaires');
        }
        $this->twigRender('admin/comments/index', compact('comments', 'returnurl', 'post', 'filterid'));
    }

    /**
     * Valid a comment
     */
    public function valid()
    {
        if ($this->user->admin) {
            if (!empty($_POST['id'])) {
                if ($this->commentTable->idExist($_POST['id'])) {
                    $this->commentTable->update($_POST['id'], array("validate" => 1));
                }
            }
        }
        header("location:index.php?p=admin_comments&id={$_POST['filterid']}");
    }

    /**
     * Delete a comment
     */
    public function delete()
    {
        if ($this->user->admin) {
            if (!empty($_POST['id'])) {
                $commentTable = $this->commentTable;
                if ($commentTable->idExist($_POST['id'])) {
                    $commentTable->delete($_POST['id']);
                }
            }
        }
        header("location:index.php?p=admin_comments&id={$_POST['filterid']}");
    }
}
