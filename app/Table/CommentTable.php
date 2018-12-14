<?php

namespace App\Table;
use Core\Table\Table;

class CommentTable extends Table
{
    public function getComments($postId, $validate = false, $result = true){
        $where = '';
        if ($validate) {
            $where = ' AND validate = true';
        }
        $query = "SELECT * FROM {$this->table} WHERE post_id = ? {$where} ORDER BY id DESC";
        if ($result) {
            return $this->db->query(
                $query,
                $this->getEntityName(),
                [$postId]
            );
        } else {
            return $this->db->query(
                $query,
                null,
                [$postId],
                null,
                false
            );
        }
    }

    public function deleteByPostId($id){
        return $this->db->query(
            "DELETE FROM {$this->table} WHERE post_id = ?",
            null,
            [$id],
            true,
            false
        );
    }
}