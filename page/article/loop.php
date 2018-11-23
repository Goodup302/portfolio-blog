<?php
use \App\Table\PostTable;
use App\App;
$app->setTitle('Tous les articles');
?>
<p>Home Page in 'page/home.php'</p>

<ul>
    <?php foreach ($app->getTable('Post')->getAll() as $post) : ?>

        <h2><a href="<?= $post->url ?>"><?= $post->title ?></a></h2>
        <p><?= $post->getExcerpt() ?></p>

    <?php endforeach; ?>

</ul>