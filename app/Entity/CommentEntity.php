<?php

namespace App\Entity;

class CommentEntity extends AuthorEntity
{
    public function getPost() {
        if (empty($this->post)) {
            $this->post = \App::getInstance()->getTable('Post')->getById($this->post_id);
        }
        return $this->post;
    }
}