<?php
$post = $db->prepare('SELECT * FROM post WHERE id = ?', '\App\Table\Post', [$_GET['id']], true);
?>

<h1><?= $post->getTitle() ?></h1>
<div><?= $post->getContent() ?></div>
<div><?= $post->getComments() ?></div>