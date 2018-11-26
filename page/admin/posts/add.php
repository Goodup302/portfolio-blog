<?php
use \Core\HTML\Form;


$form = new Form($_POST);
?>

<h2>Ajouter un nouvel article</h2>
<form method="post">
    <?= $form->input('title', 'Titre', 'text') ?>
    <?= $form->input('excerpt', 'Extrait', 'text') ?>
    <?= $form->input('content', 'Contenu', 'textarea') ?>

    <?= $form->submit('Ajouter') ?>
</form>