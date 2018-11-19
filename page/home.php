<p>Home Page in 'page/home.php'</p>

<ul>
    <?php foreach ($db->query('SELECT * FROM post', '\App\Table\Post') as $post) : ?>

        <h2><a href="<?= $post->getUrl() ?>"><?= $post->getTitle() ?></a></h2>
        <p><?= $post->getContent() ?></p>
    
    <?php endforeach; ?>

</ul>