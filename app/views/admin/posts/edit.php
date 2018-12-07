<div class="col-md-12">
    <a href="index.php?p=admin_posts">Retour</a>
    <h2>Editer l'article</h2>
</div>

<div class="col-md-12">
    <form method="post">
        <?= $form->input('title', 'Titre', 'text', $post->title) ?>
        <?= $form->input('image', 'Url image', 'url', $post->image) ?>
        <?= $form->input('excerpt', 'Extrait', 'text', $post->excerpt) ?>
        <?= $form->input('content', 'Contenu', 'textarea', $post->content) ?>
        <?= $form->submit('Modifier') ?>
    </form>
</div>
