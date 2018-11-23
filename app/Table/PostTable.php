<?php

namespace App\Table;
use App\App;
use App\Config;

class PostTable extends Table
{

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
            return substr($this->content, 0, Config::getInstance()->get('excerpt_length'));
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