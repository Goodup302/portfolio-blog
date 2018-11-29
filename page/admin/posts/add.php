<?php
use \Core\HTML\Form;
use \Core\HTML\Alert;
use \Core\Auth\DBAuth;
use \Core\HTML\BootstrapStyle;

$auth = new DBAuth(App::getInstance()->getDatabase());

//Update Post
if (isset($_POST) && $_POST != null) {
    $postTable = App::getInstance()->getTable('Post');
    if (!$postTable->titleExist($_POST['title'])) {
        $args = array(
            "user_id" => $auth->getUserId(),
            "title" => $_POST['title'],
            "excerpt" => $_POST['excerpt'],
            "content" => $_POST['content'],
            "lastdate" => date('Y-m-d H:i:s')
        );
        $postTable->insert($args);
        header('location:admin.php?p=post_edit&id=' . App::getInstance()->getDatabase()->getLastId());
    } else {
        (new Alert("Cette article existe déjà", BootstrapStyle::danger))->show();
    }
}

//Html
$form = new Form($_POST);
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