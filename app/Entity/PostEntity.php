<?php

namespace App\Entity;
use Core\Config;

class PostEntity
{
    const EXCERPT_LENGTH = 100;

    use AuthorAble;

    public function getUrl()
    {
        return 'index.php?p=single&id=' . $this->id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getExcerpt($forceExcerpt = false)
    {
        if (strlen($this->excerpt) > 0 || $forceExcerpt == true) {
            return $this->excerpt;
        } else {
            return substr($this->content, 0, self::EXCERPT_LENGTH);
        }
    }

    public function getLastdate()
    {
        $date = date_create($this->lastdate);
        return 'Rédigé le ' . date_format($date, 'd/m/Y') . ' à ' . date_format($date, 'H:i');
    }

    public function getAuthorid()
    {
        return $this->user_id;
    }
}
