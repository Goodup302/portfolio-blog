<?php

namespace Core;
use \PDO;

class DataBase
{
    private $host;
    private $name;
    private $user;
    private $password;

    private $pdo;

    /**
     * DataBase constructor.
     * @param $name
     * @param string $host
     * @param string $user
     * @param string $password
     */
    public function __construct($name, $host = '127.0.0.1', $user = 'root', $password = 'root')
    {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @return PDO
     */
    private function getPDO()
    {
        if ($this->pdo == null) {
            $pdo = new PDO("mysql:dbname={$this->name};host={$this->host}", $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    /**
     * @param $statement
     * @param null $className
     * @param null $args
     * @param bool $isSingle
     * @param bool $return
     * @return array|int|mixed
     */
    public function query($statement, $className = null, $args = null, $isSingle = false, $return = true)
    {
        if (!is_null($args)) {
            $request = $this->getPDO()->prepare($statement);
            $request->execute($args);
        } else {
            $request = $this->getPDO()->query($statement);
        }
        if (!$return) {
            return $request->rowCount();
        }
        //
        if (!is_null($className)) {
            $request->setFetchMode(PDO::FETCH_CLASS, $className);
        } else {
            $request->setFetchMode(PDO::FETCH_OBJ);
        }
        //
        if ($isSingle) {
            $result = $request->fetch();
        } else {
            $result = $request->fetchAll();
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getLastId()
    {
        return $this->getPDO()->lastInsertId();
    }
}
