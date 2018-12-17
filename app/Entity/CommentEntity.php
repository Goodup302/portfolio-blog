<?php

namespace App\Entity;

class CommentEntity extends AuthorEntity
{
    public function getPost()
    {
        if (empty($this->post)) {
            $this->post = \App::getInstance()->getTable('Post')->getById($this->post_id);
        }
        return $this->post;
    }

    public function getdate()
    {
        $date = date_create($this->date);
        $day = date_format($date, 'd/m/Y');
        $hours = date_format($date, 'H:i');
        return "Ajouté le {$day} à {$hours}";
    }
}
