
    <div class="col-md-12">
        <a href="?p=admin_posts">Retour</a>
        <h2>Ajouter un article</h2>
        <form method="post">
            <?= $form->input('title', 'Titre', 'text') ?>
            <?= $form->input('image', 'Url image', 'url') ?>
            <?= $form->input('excerpt', 'Extrait', 'text') ?>
            <?= $form->input('content', 'Contenu', 'textarea') ?>

            <?= $form->submit('Ajouter') ?>
        </form>
    </div>