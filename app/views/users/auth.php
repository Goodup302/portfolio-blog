<?php
use \Core\HTML\Form;
use \Core\HTML\Alert;
use \Core\Auth\DBAuth;
use \Core\HTML\BootstrapStyle;

?>
<div class="col-md-12">
    <?= $alert->show(); ?>
    <form method="post">
        <?= $form->input('login', 'Login', 'text') ?>
        <?= $form->input('password', 'Password', 'password') ?>
        <?= $form->submit('Se connecter') ?>
    </form>
</div>
