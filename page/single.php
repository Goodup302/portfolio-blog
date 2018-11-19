<?php
use \App\Table\Post;
use \App\Table\Comment;
use \App\Table\User;
use App\App;

if (isset($_GET['id']) && $_GET['id'] != null) {
        $post = Post::getById($_GET['id']);
        $author = User::getById($post->getAuthorId());
        if ($post) {
            App::setTitle('Article: '.$post->title);
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
                <?php foreach (Comment::getComments($_GET['id'], true) as $comment) :
                    $author = User::getById($comment->user_id);
                ?>
                    <li>
                        <span><?= $author->username ?></span>
                        <p><?= $comment->content ?></p>
                    </li>

                <?php endforeach; ?>
            </ul>
            <?php
        } else {
            App::error404("Cette article n'existe pas !");
        }
} else {
    App::error404("Aucun article selectionné !");
}
?>