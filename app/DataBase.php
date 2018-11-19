<?php

namespace App;
use \PDO;

class DataBase
{
    private $host;
    private $name;
    private $user;
    private $password;

    private $pdo;

    public function __construct($name, $host = '127.0.0.1', $user = 'root', $password = 'root')
    {
        $this->host = $host;
        $this->name = $name;
        $this->user = $user;
        $this->password = $password;
    }

    private function getPDO() {
        if ($this->pdo == null) {
            $pdo = new PDO('mysql:dbname='.$this->name.';host=' . $this->host, $this->user, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query($statement, $className) {
        $request = $this->getPDO()->query($statement);
        return $request->fetchAll(PDO::FETCH_CLASS, $className);
    }

    public function prepare($statement, $className, $args, $isSingle = false) {
        $request = $this->getPDO()->prepare($statement);
        $request->execute($args);
        $request->setFetchMode(PDO::FETCH_CLASS, $className);
        if ($isSingle) {
            $result = $request->fetch();
        } else {
            $result = $request->fetchAll();
        }
        return $result;
    }
    public function prepareUpdate($statement, $args) {
        var_dump($args);
        $request = $this->getPDO()->prepare($statement);
        return $request->execute($args);
    }
}