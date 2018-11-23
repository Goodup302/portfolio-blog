<?php
use \App\Table\PostTable;
use \App\Table\CommentTable;
use \App\Table\UserTable;
use App\App;

if (isset($_GET['id']) && $_GET['id'] != null) {
        $post = $app->getTable('Post')->getById($_GET['id']);
        $author = $app->getTable('User')->getById($post->getAuthorId());
        if ($post) {
            $app->setTitle('Article: '.$post->title);
            ?>
            <h1><?= $post->title ?></h1>
            <p><?= $post->getLastDate() ?></p>

            <?php
            $excerpt = $post->getExcerpt(true);
            if (strlen($excerpt) > 0) {
                echo '<p>'.$excerpt.'</p>';
            }
            ?>


            <p><?= $post->getContent() ?></p>
            <p>Auteur: <?= $author->username ?></p>

            <ul>
                <?php foreach ($app->getTable('Comment')->getComments($_GET['id'], true) as $comment) :
                    $author = $app->getTable('User')->getById($comment->user_id);
                ?>
                    <li>
                        <span><?= $author->username ?></span>
                        <p><?= $comment->content ?></p>
                    </li>

                <?php endforeach; ?>
            </ul>
            <?php
        } else {
            $app->error404("Cette article n'existe pas !");
        }
} else {
    $app->error404("Aucun article selectionné !");
}
?>