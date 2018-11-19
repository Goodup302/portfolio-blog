<?php

namespace App\Table;

class Post
{
    public function getUrl() {
        return 'index.php?p=post&id='. $this->id;
    }
    public function getContent() {
        return $this->content;
    }
    public function getExcerpt() {
        return $this->excerpt;
    }
    public function getLastDate() {
        return $this->lastdate;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getComments() {
        return 1;
    }
}