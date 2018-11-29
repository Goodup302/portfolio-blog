<?php
use \Core\HTML\Form;
use \Core\HTML\Alert;
use \Core\Auth\DBAuth;

$auth = new DBAuth(App::getInstance()->getDatabase());

if ($auth->isLogged()) {
    header("location:admin.php");
}

$alert = new Alert('Veuillez entrer les informations suivantes pour vous connécter', Alert::info);
if (!empty($_POST)) {
    $status = $auth->login($_POST['login'], $_POST['password']);
    if ($status === true) {
        header("location:admin.php");
    } else {
        $alert = new Alert($status, Alert::warning);
    }
}


$form = new Form($_POST);
?>
<div class="col-md-12">
    <div class="d-flex justify-content-center">
        <?= $alert->show(); ?>
    </div>
    <form method="post">
        <?= $form->input('login', 'Login', 'text') ?>
        <?= $form->input('password', 'Password', 'password') ?>
        <?= $form->submit('Se connecter') ?>
    </form>
</div>
