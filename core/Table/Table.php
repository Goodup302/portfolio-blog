<?php

namespace Core\Table;
use \Core\DataBase;

class Table
{
    protected $table;
    protected $db;

    /**
     * Table constructor.
     * @param DataBase|null $db
     */
    public function __construct(DataBase $db = null)
    {
        if ($db != null) {
            $this->db = $db;
        }
        if (is_null($this->table)) {
            $array = explode('\\', get_class($this));
            $class_name = end($array);
            //
            $this->table = strtolower(str_replace('Table', '', $class_name));
        }
    }

    /**
     * @return string
     */
    public function getLastId()
    {
        return $this->db->getLastId();
    }

    /**
     * @return array|int|mixed
     */
    public function getAll()
    {
        return $this->db->query(
            "SELECT * FROM {$this->table} ORDER BY id DESC",
            $this->getEntityName()
        );
    }

    /**
     * @param $id
     * @return array|int|mixed
     */
    public function getById($id)
    {
        return $this->db->query(
            "SELECT * FROM {$this->table} WHERE id = ?",
            $this->getEntityName(),
            [$id],
            true
        );
    }

    /**
     * @param $id
     * @return bool
     */
    public function idExist($id)
    {
        return boolval($this->db->query(
            "SELECT * FROM {$this->table} WHERE id = ?",
            null,
            [$id],
            true,
            false
        ));
    }

    /**
     * @param $data
     * @return array|int|mixed
     */
    public function insert($data)
    {
        $sql_index = [];
        $sql_entry = [];
        $attributes = [];
        foreach ($data as $key => $value) {
            $sql_index[] = "$key";
            $sql_entry[] = "?";
            $attributes[] = $value;
        }
        $sql_index = implode(', ', $sql_index);
        $sql_entry = implode(', ', $sql_entry);

        return $this->db->query(
            "INSERT INTO {$this->table} ( $sql_index ) VALUES( $sql_entry )",
            null,
            $attributes,
            null,
            false
        );
    }

    /**
     * @param $id
     * @param $data
     * @return array|int|mixed
     */
    public function update($id, $data)
    {
        $sql_parts = [];
        $attributes = [];
        foreach ($data as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }
        $attributes[] = $id;
        $sql_parts = implode(', ', $sql_parts);

        return $this->db->query(
            "UPDATE {$this->table} SET {$sql_parts} WHERE id = ?",
            null,
            $attributes,
            null,
            false
        );
    }

    /**
     * @return int|null
     */
    public function count()
    {
        return intval($this->db->query(
            "SELECT COUNT(*) FROM {$this->table}",
            false,
            null,
            true
        )[0]);
    }

    /**
     * @param $id
     * @return array|int|mixed
     */
    public function delete($id)
    {
        return $this->db->query(
            "DELETE FROM {$this->table} WHERE id = ?",
            null,
            [$id],
            true,
            false
        );
    }

    /**
     * @return mixed
     */
    public function getEntityName()
    {
        return str_replace('Table', 'Entity', get_class($this));
    }
}
