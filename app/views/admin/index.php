<?php
use Core\HTML\Button;

(new Button('Articles'))->setUrl('?p=posts')->show();
(new Button('Commentaires'))->setUrl('?p=comments')->show();