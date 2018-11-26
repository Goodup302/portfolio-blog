<?php
use \Core\HTML\Form;
use \Core\Auth\DBAuth;

if (!empty($_POST)) {
    $auth = new DBAuth(App::getInstance()->getDatabase());
    if ($auth->login($_POST['login'], $_POST['password'])) {
        header("location:admin.php");
    } else {
        print_r('Wrong fildes');
    }
}


$form = new Form($_POST);
?>

<form method="post">
    <?= $form->input('login', 'text') ?>
    <?= $form->input('password', 'pasword') ?>
    <?= $form->submit('Se connecter') ?>
</form>
