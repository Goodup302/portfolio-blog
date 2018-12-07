 <div class="col-md-12">
     <h1>Titre : <?= $post->title ?></h1>
     <p>Date : <?= $post->getLastDate() ?></p>

     <?php
     if (strlen($excerpt) > 0) {
         echo '<p>Extrait: '.$excerpt.'</p>';
     }
     ?>

     <p>Contenu: <?= $post->getContent() ?></p>
     <p>Auteur: <?= $author->username ?></p>

     <ul>
         <?php foreach ($comments as $comment) :
             $author = $app->getTable('User')->getById($comment->user_id);
             ?>
             <li>
                 <span><?= $author->username ?></span>
                 <p><?= $comment->content ?></p>
             </li>
         <?php endforeach; ?>
     </ul>
 </div>