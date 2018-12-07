<?php
use Core\HTML\Button;

(new Button('Articles'))->setUrl('?p=admin_posts')->show();
(new Button('Commentaires'))->setUrl('?p=admin_comments')->show();