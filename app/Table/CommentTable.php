<?php

namespace App\Table;
use Core\Table\Table;

class CommentTable extends Table
{
    use DBinjection;

    /**
     * @param $postId
     * @param bool $validate
     * @param bool $result
     * @return array|int|mixed
     */
    public function getComments($postId, $validate = false, $result = true)
    {
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

    /**
     * @param $id
     * @return array|int|mixed
     */
    public function deleteByPostId($id)
    {
        return $this->db->query(
            "DELETE FROM {$this->table} WHERE post_id = ?",
            null,
            [$id],
            true,
            false
        );
    }
}
