<?php
use \Core\Auth\DBAuth;


$auth = new DBAuth(App::getInstance()->getDatabase());
$user = $app->getTable('User')->getById($auth->getUserId());
if ($user->admin) {
    if (!empty($_POST['id'])) {
        $commentTable = App::getInstance()->getTable('Comment');
        if ($commentTable->idExist($_POST['id'])) {
            $commentTable->delete($_POST['id']);
        }
    }
}
header('location:admin.php?p=comments');