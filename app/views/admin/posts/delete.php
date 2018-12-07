<?php
use \Core\HTML\Alert;
use \Core\Auth\DBAuth;


$auth = new DBAuth(App::getInstance()->getDatabase());
$user = $app->getTable('User')->getById($auth->getUserId());

if (!empty($_POST['id'])) {
    $postTable = App::getInstance()->getTable('Post');
    $post = $postTable->getById($_POST['id']);
    if ($user->canEditPost($post)) {
        $postTable->delete($_POST['id']);
    }
}
header('location:admin.php');
?>