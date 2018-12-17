<?php

namespace App\Entity;

use Core\Entity\Entity;

class UserEntity extends Entity
{

    public function getAdmin()
    {
        return boolval($this->admin);
    }

    public function canEditPost($post)
    {
        if ($this->getAdmin()) {
            return true;
        } elseif ($post->user_id === $this->id) {
            return true;
        }
        return false;
    }
}
