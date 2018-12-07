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


    public function loop() {
        if ($this->user->admin) {
            $comments = $this->Comment->getAll();
            $form = new Form();
            $app = \App::getInstance();
            $this->render('admin/comments/index', compact('app', 'comments', 'form'));
        } else {
            (new Alert(PermissionMessage::PAGE_PERMISSION_DENIED, BootstrapStyle::danger))->show();
        }
    }

    public function valid() {
        if ($this->user->admin) {
            if (!empty($_POST['id'])) {
                $commentTable = $this->Comment;
                if ($commentTable->idExist($_POST['id'])) {
                    $commentTable->update($_POST['id'], array("validate" => 1));
                }
            }
        }
        $this->loop();
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
        $this->loop();
    }
}