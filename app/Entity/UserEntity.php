<?php

namespace App\Entity;
use Core\Entity\Entity;

class UserEntity extends Entity
{
    public function getAdmin() {
        return boolval($this->admin);
    }
}