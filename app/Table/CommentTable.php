<?php

namespace App\Table;
use Core\Table\Table;

class CommentTable extends Table
{
    public function getComments($postId, $validate = false){
        if ($validate) {
            $where = ' AND validate = true';
        } else {
            $where = '';
        }
        return $this->db->query(
            'SELECT * FROM ' . $this->table .' WHERE post_id = ?'.$where.' ORDER BY id DESC',
            $this->getEntityName(),
            [$postId]
        );
    }

    public function add($postId, $userId, $content, $validate = false) {
        $query = '
            INSERT INTO ' . $this->table .'
            (post_id, user_id, content, validate)
            VALUES(?, ?, ?, ?);
        ';
        return $this->db->query(
            $query,
            null,
            array($postId, $userId, $content, intval($validate))
        );
    }
}