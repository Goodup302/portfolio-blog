<?php

namespace App\Table;
use App\App;

class Post extends Table
{
    protected static $table = 'post';

    public function getUrl() {
        return 'index.php?p=single&id='. $this->id;
    }
    public function getContent() {
        return $this->content;
    }
    public function getExcerpt($forceExcerpt = false) {
        if (strlen($this->excerpt) > 0 || $forceExcerpt == true) {
            return $this->excerpt;
        } else {
            return substr($this->content, 0, APP::EXCERPT_LENGTH);
        }
    }
    public function getLastDate() {
        $date = date_create($this->lastdate);
        return 'Rédigé le '.date_format($date, 'd/m/Y').' à '.date_format($date, 'H:i');
    }

    public function getAuthorId() {
        return $this->user_id;
    }
}