<div class="col-md-12">
    <p>Home Page in 'page/home.php'</p>
    <ul>
        <?php foreach ($posts as $post) : ?>

            <h2><a href="<?= $post->url ?>"><?= $post->title ?></a></h2>
            <p><?= $post->getExcerpt() ?></p>

        <?php endforeach; ?>
    </ul>
</div>