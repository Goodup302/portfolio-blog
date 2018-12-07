<div class="col-md-12">
    <h1>Tout les articles</h1>
    <ul>
        <?php foreach ($posts as $post) : ?>
        <li>
            <h4><a href="<?= $post->url ?>"><?= $post->title ?></a></h4>
            <p><?= $post->getExcerpt() ?></p>
        </li>
        <?php endforeach; ?>
    </ul>
</div>