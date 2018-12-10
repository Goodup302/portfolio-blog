<?php

namespace App\Entity;
use Core\Entity\Entity;

class CommentEntity extends Entity
{
    public function getAuthor() {
        if (empty($this->author)) {
            $this->author = \App::getInstance()->getTable('User')->getById($this->user_id);
        }
        return $this->author;
    }
}