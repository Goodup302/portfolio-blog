<?php
use \Core\HTML\Form;
var_dump(date_default_timezone_get());
if (isset($_GET['id']) && $_GET['id'] != null) {
    $posts = App::getInstance()->getTable('Post');
    if (isset($_POST) && $_POST != null) {
        $args = array(
            "title" => $_POST['title'],
            "excerpt" => $_POST['excerpt'],
            "content" => $_POST['content'],
            "lastdate" => date('Y-m-d H:i:s')
        );
        $posts->update($_GET['id'], $args);
    }
    $post = $posts->getById($_GET['id']);

    $form = new Form($_POST);

    ?>
        <h2>Editer l'article</h2>
        <form method="post">
            <?= $form->input('title', 'Titre', 'text', $post->title) ?>
            <?= $form->input('excerpt', 'Extrait', 'text', $post->excerpt) ?>
            <?= $form->input('content', 'Contenu', 'textarea', $post->content) ?>

            <?= $form->submit('Modifier') ?>
        </form>
    <?php
}
