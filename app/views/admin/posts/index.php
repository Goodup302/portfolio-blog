<?php
use \Core\HTML\BootstrapStyle;
use \Core\HTML\Button;
?>


<div class="col-md-12">
    <a href="?p=admin">Retour</a>
    <h2>Liste des articles</h2>
    <?=
    (new Button('Ajouter un article','button', BootstrapStyle::success))
        ->setUrl('?p=admin_posts_add')
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
                            ->setUrl("?p=admin_posts_edit&id=$post->id")
                            ->show();
                        ?>
                        <form method="post" action="?p=admin_posts_delete" style="display: inline;">
                            <?= $form->addValue('id', $post->id) ?>
                            <?= $form->submit('Supprimer', BootstrapStyle::danger) ?>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>