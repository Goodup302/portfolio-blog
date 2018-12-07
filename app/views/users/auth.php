<?php
use \Core\HTML\Form;
use \Core\HTML\Alert;
use \Core\Auth\DBAuth;
use \Core\HTML\BootstrapStyle;

$auth = new DBAuth(App::getInstance()->getDatabase());
if (!empty($_GET['disconnect']) && $_GET['disconnect'] && $auth->isLogged()) {
    $auth->signOut();
    $alert = new Alert('Vous venez de vous déconnecter', BootstrapStyle::info);
} else {
    if ($auth->isLogged()) { header("location:admin.php"); }

    $alert = new Alert('Veuillez entrer les informations suivantes pour vous connécter', BootstrapStyle::info);
    if (!empty($_POST)) {
        $status = $auth->login($_POST['login'], $_POST['password']);
        if ($status === true) {
            header("location:admin.php");
        } else {
            $alert = new Alert($status, BootstrapStyle::warning);
        }
    }
}



$form = new Form($_POST);
?>
<div class="col-md-12">
    <?= $alert->show(); ?>
    <form method="post">
        <?= $form->input('login', 'Login', 'text') ?>
        <?= $form->input('password', 'Password', 'password') ?>
        <?= $form->submit('Se connecter') ?>
    </form>
</div>
