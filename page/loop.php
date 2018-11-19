<?php
use \App\Table\Post;
use App\App;
App::setTitle('Tous les articles');
?>
<p>Home Page in 'page/home.php'</p>

<ul>
    <?php foreach (Post::getAll() as $post) : ?>

        <h2><a href="<?= $post->getUrl() ?>"><?= $post->title ?></a></h2>
        <p><?= $post->getExcerpt(); ?></p>
        <p><?= $post->getContent() ?></p>

    <?php endforeach; ?>

</ul>