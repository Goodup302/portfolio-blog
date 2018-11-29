<?php
use \Core\HTML\Form;
use \Core\Auth\DBAuth;

$auth = new DBAuth(App::getInstance()->getDatabase());

//Update Post
if (isset($_POST) && $_POST != null) {
    $args = array(
        "user_id" => $auth->getUserId(),
        "title" => $_POST['title'],
        "excerpt" => $_POST['excerpt'],
        "content" => $_POST['content'],
        "lastdate" => date('Y-m-d H:i:s')
    );
    $postTable = App::getInstance()->getTable('Post');
    $postTable->insert($args);
}

//Html
$form = new Form(null);
?>
    <div class="col-md-12">
        <a href="admin.php">Retour</a>
        <h2>Ajouter un article</h2>
        <form method="post">
            <?= $form->input('title', 'Titre', 'text') ?>
            <?= $form->input('excerpt', 'Extrait', 'text') ?>
            <?= $form->input('content', 'Contenu', 'textarea') ?>

            <?= $form->submit('Ajouter') ?>
        </form>
    </div>
<?php