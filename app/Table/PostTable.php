<?php

namespace App\Table;
use Core\Table\Table;

class PostTable extends Table
{
    use DBinjection;

    /**
     * @param $id
     * @return array|int|mixed
     */
    public function getByUserId($id)
    {
        return $this->db->query(
            "SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY id DESC",
            $this->getEntityName(),
            [$id]
        );
    }

    /**
     * @param $title
     * @return bool
     */
    public function titleExist($title)
    {
        return boolval($this->db->query(
            "SELECT * FROM {$this->table} WHERE title = ?",
            null,
            [$title],
            true,
            false
        ));
    }
}
