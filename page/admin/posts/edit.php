<?php
use \Core\HTML\Form;
use \Core\HTML\Alert;
use \Core\Auth\DBAuth;
use \Core\HTML\BootstrapStyle;

$auth = new DBAuth(App::getInstance()->getDatabase());
$user = $app->getTable('User')->getById($auth->getUserId());

?>
<div class="col-md-12">
    <a href="admin.php">Retour</a>
    <h2>Editer l'article</h2>
</div>
<?php
if (isset($_GET['id']) && $_GET['id'] != null) {
    $postTable = App::getInstance()->getTable('Post');
    if ($postTable->idExist($_GET['id'])) {
        $post = $postTable->getById($_GET['id']);
        if ($user->canEditPost($post)) {

            //Update Post
            if (isset($_POST) && $_POST != null) {
                $args = array(
                    "title" => $_POST['title'],
                    "excerpt" => $_POST['excerpt'],
                    "content" => $_POST['content'],
                    "image" => $_POST['image'],
                    "lastdate" => date('Y-m-d H:i:s')
                );
                $postTable->update($_GET['id'], $args);
            }

            //Html
            $form = new Form($_POST);
            $post = $postTable->getById($_GET['id']);
            ?>
            <div class="col-md-12">
                <form method="post">
                    <?= $form->input('title', 'Titre', 'text', $post->title) ?>
                    <?= $form->input('image', 'Url image', 'url') ?>
                    <?= $form->input('excerpt', 'Extrait', 'text', $post->excerpt) ?>
                    <?= $form->input('content', 'Contenu', 'textarea', $post->content) ?>

                    <?= $form->submit('Modifier') ?>
                </form>
            </div>
            <?php
        } else {
            (new Alert("Cette article ne vous appartient pas", BootstrapStyle::danger))->show();
        }
    } else {
        (new Alert("Cette article n'existe pas ou plus", BootstrapStyle::warning))->show();
    }
} else {
    header('location:admin.php');
}
?>
