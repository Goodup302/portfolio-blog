<?php
use \Core\Auth\DBAuth;
use \Core\HTML\Form;
use \Core\HTML\BootstrapStyle;
use \Core\HTML\Popup;
use \Core\HTML\Alert;
use \App\Permission\PermissionMessage;

$auth = new DBAuth(App::getInstance()->getDatabase());
$user = $app->getTable('User')->getById($auth->getUserId());

if ($user->admin) {
    $comments = $app->getTable('Comment')->getAll();


    $form = new Form();
    ?>


    <div class="col-md-12">
        <a href="admin.php">Retour</a>
        <h2>Liste des commentaires</h2>
        <p></p>
    </div>

    <div class="col-md-12">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Auteur</th>
                <th scope="col">Article</th>
                <th scope="col">Date de création</th>
                <th scope="col">Contenu</th>
                <th scope="col">Action</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($comments as $comment) :
                $author = $app->getTable('User')->getById($comment->user_id);
                $post = $app->getTable('Post')->getById($comment->post_id); ?>
                <tr>
                    <td><?= $author->username ?></td>
                    <td><?= $post->title ?></td>
                    <td><?= $comment->date ?></td>
                    <td><?= $comment->content ?></td>
                    <td>
                        <?php if (!$comment->validate) { ?>
                            <form method="post" action="?p=comment_valid" style="display: inline;">
                                <?= $form->addValue('id', $comment->id) ?>
                                <?= $form->submit('Valider', BootstrapStyle::success) ?>
                            </form>
                        <?php } ?>

                        <form method="post" action="?p=comment_delete" style="display: inline;">
                            <?= $form->addValue('id', $comment->id) ?>
                            <?= $form->submit('Supprimer', BootstrapStyle::danger) ?>
                        </form>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                            Ouvrir
                        </button>
                        <?php
                        (new Popup('comment-content-popup'.$comment->id, 'sdfsdfsd'))->showButton();
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    (new Alert(PermissionMessage::PAGE_PERMISSION_DENIED, BootstrapStyle::danger))->show();
}
