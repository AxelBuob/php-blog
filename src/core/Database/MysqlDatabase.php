<?php

namespace Core\Database;

use \PDO;

class MysqlDatabase
{
    private $pdo;
    private $db_name;
    private $db_host;
    private $db_user;
    private $db_pass;

    public function __construct($db_name, $db_host, $db_user, $db_pass)
    {
        $this->db_name = $db_name;
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
    }

    private function getPDO()
    {
        if($this->pdo === null)
        {
            $pdo = new PDO("mysql:dbname={$this->db_name};host={$this->db_host}", "{$this->db_user}", "{$this->db_pass}");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query($statement, $class_name = null, $unique = false)
    {
        $query = $this->getPDO()->query($statement);
        if (strpos($statement, 'UPDATE') === 0 || strpos($statement, 'INSERT') === 0 || strpos($statement, 'DELETE') === 0) {
            return $query;
        }
        if($class_name === null)
        {
            $query->setFetchMode(PDO::FETCH_OBJ);
        }
        else
        {
            $query->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($unique === true) {
            $query = $query->fetch();
        } else {
            $query = $query->fetchAll();
        }
        return $query;
    }


    public function prepare($statement, $attributes, $class_name = null, $unique = false)
    {
        $query = $this->getPDO()->prepare($statement);
        $result = $query->execute($attributes);
        if(strpos($statement, 'UPDATE') === 0 || strpos($statement, 'INSERT') === 0 || strpos($statement, 'DELETE') === 0)
        {
            return $result;
        }
        if ($class_name === null) {
            $query->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $query->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($unique === true) {
            $query = $query->fetch();
        } else {
            $query = $query->fetchAll();
        }
        return $query;
    }

    public function lastInsertId()
    {
        return $this->getPDO()->lastInsertId();
    }
}