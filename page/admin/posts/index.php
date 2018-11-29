<?php
use \Core\Auth\DBAuth;


$auth = new DBAuth(App::getInstance()->getDatabase());
$user = $app->getTable('User')->getById($auth->getUserId());

if ($user->admin) {
    $posts = $app->getTable('Post')->getAll();
} else {
    $posts = $app->getTable('Post')->getByUserId($auth->getUserId());
}
?>



<h2>Liste des articles</h2>

<a href="admin.php?p=post_add" type="button" role="button" class="btn btn-primary btn-success">Ajouter un article</a>
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
                    <a href="admin.php?p=post_edit&id=<?= $post->id ?>">Modifier</a>
                    |
                    <a href="admin.php?p=post_delete&id=<?= $post->id ?>">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
