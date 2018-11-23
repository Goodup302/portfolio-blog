<?php

namespace App\Table;
use Core\Table\Table;

class CommentTable extends Table
{
    public function getComments($postId, $validate = false) {
        if ($validate) {
            $query = 'SELECT * FROM ' . $this->table .' WHERE post_id = ? AND validate = true';
        } else {
            $query = 'SELECT * FROM ' . $this->table .' WHERE post_id = ?';
        }
        return App::getInstance()->getDatabase()->prepare($query, get_class($this), [$postId]);
    }
    public function add($postId, $userId, $content, $validate = false) {
        $query = '
            INSERT INTO ' . $this->table .'
            (post_id, user_id, content, validate)
            VALUES(?, ?, ?, ?);
        ';
        return App::getInstance()->getDatabase()->prepareUpdate($query, array($postId, $userId, $content, intval($validate)));
    }
}