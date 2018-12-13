<?php

namespace App\Controller\Admin;
use \Core\Auth\DBAuth;
use \Core\HTML\Form;
use \Core\HTML\BootstrapStyle;
use \Core\HTML\Popup;
use \Core\HTML\Alert;
use \App\Permission\PermissionMessage;

class CommentController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Post');
        $this->loadModel('Comment');
        $this->loadModel('User');
    }


    public function loop($filterid = null) {
        if (is_null($filterid) && !empty($_GET['id'])) {
            $filterid = $_GET['id'];
        }
        if (!empty($filterid)) {
            $comments = $this->Comment->getComments($filterid);
            $returnurl = 'index.php?p=admin_posts_edit&id='.$filterid;
            $post = $this->Post->getById($filterid);
        } else {
            $comments = $this->Comment->getAll();
            $returnurl = 'index.php?p=admin';
        }
        $this->twigRender('admin/comments/index', compact('comments', 'returnurl', 'post', 'filterid'));
    }

    public function valid() {
        if ($this->user->admin) {
            if (!empty($_POST['id'])) {
                if ($this->Comment->idExist($_POST['id'])) {
                    $this->Comment->update($_POST['id'], array("validate" => 1));
                }
            }
        }
        header("location:index.php?p=admin_comments&id=".$_POST['filterid']);
    }

    public function delete() {
        if ($this->user->admin) {
            if (!empty($_POST['id'])) {
                $commentTable = $this->Comment;
                if ($commentTable->idExist($_POST['id'])) {
                    $commentTable->delete($_POST['id']);
                }
            }
        }
        header("location:index.php?p=admin_comments&id=".$_POST['filterid']);
    }
}