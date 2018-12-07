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

    public function deleteByPostId($id){
        return $this->db->query(
            'DELETE FROM ' . $this->table .' WHERE post_id = ?',
            null,
            [$id],
            true,
            false
        );
    }
}