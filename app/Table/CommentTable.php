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
    public function getByPostId($postId, $validate = null, $result = true)
    {
        $where = '';
        if ($validate == true) {
            $where = ' AND validate = true';
        } elseif ($validate == false) {
            $where = ' AND validate = false';
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
     * Get all comments by validity
     *
     * @param bool $validate
     * @param bool $result
     * @return array|int|mixed
     */
    public function getByValidity($validate = true, $result = true)
    {
        $query = "SELECT * FROM {$this->table} WHERE validate = ? ORDER BY id DESC";
        if ($result) {
            return $this->db->query(
                $query,
                $this->getEntityName(),
                [$validate]
            );
        } else {
            return $this->db->query(
                $query,
                null,
                [$validate],
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
