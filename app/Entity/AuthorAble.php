<?php

namespace App\Entity;
use App\Table\UserTable;

trait AuthorAble
{
    public function getAuthor()
    {
        if (empty($this->author)) {
            $this->author = (new UserTable())->getById($this->user_id);
        }
        return $this->author;
    }
}
