<?php
use \Core\Auth\DBAuth;
use \Core\HTML\Form;
use \Core\HTML\BootstrapStyle;
use \Core\HTML\Button;

$auth = new DBAuth(App::getInstance()->getDatabase());
$user = $app->getTable('User')->getById($auth->getUserId());

if ($user->admin) {
    $posts = $app->getTable('Post')->getAll();
} else {
    $posts = $app->getTable('Post')->getByUserId($auth->getUserId());
}
$form = new Form();
?>


<div class="col-md-12">
    <a href="admin.php">Retour</a>
    <h2>Liste des articles</h2>
    <?=
    (new Button('Ajouter un article','button', BootstrapStyle::success))
        ->setUrl('?p=post_add')
        ->show();
    ?>
    <p></p>
</div>

<div class="col-md-12">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Titre</th>
                <th scope="col">Auteur</th>
                <th scope="col">Dernière modification</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($posts as $post) :
                $author = $app->getTable('User')->getById($post->user_id); ?>
                <tr>
                    <td><?= $post->title ?></td>
                    <td><?= $author->username ?></td>
                    <td><?= $post->lastdate ?></td>
                    <td>
                        <?=
                        (new Button('Modifier','button'))
                            ->setUrl("?p=post_edit&id=$post->id")
                            ->show();
                        ?>
                        <form method="post" action="?p=post_delete" style="display: inline;">
                            <?= $form->addValue('id', $post->id) ?>
                            <?= $form->submit('Supprimer', BootstrapStyle::danger) ?>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>