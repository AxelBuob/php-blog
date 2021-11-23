<?php
namespace Core\Table;

use Core\Database\MysqlDatabase;
use Core\Html\Html;

class Table
{

    protected $table;
    protected $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
    }

    public function getDB()
    {
        return $this->db;
    }

    public function getLastId()
    {
        return $this->db->lastInsertId();
    }


    public function query($statement, $attributes, $class_name, $unique)
    {
        if($attributes === null)
        {
            $query = $this->db->query($statement, $class_name, $unique);
        }
        else
        {
            $query = $this->db->prepare($statement, $attributes,  $class_name, $unique);
        }

        return $query;
    }

    public function all()
    {
        $query = $this->query("SELECT * FROM " .$this->table, null, null, false);
        return $query;
    }

    public function find($id)
    {
        $query = $this->query("SELECT * FROM " . $this->table . " WHERE id = ?", [$id], null, true);
        return $query;
    }


    public function update($id, $fields)
    {
        $sql_parts = [];
        $attributes = [];
        foreach($fields as $key => $value)
        {
            $sql_parts[] = "$key = ?";
            $attributes[] = $value;
        }
        $sql_part = implode(',', $sql_parts);
        $attributes[] = $id;

        return $this->query("UPDATE {$this->table} SET {$sql_part} WHERE id = ?", $attributes, null, true);
    }

    public function create($fields)
    {
        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $key => $value) {
            $sql_parts[] = "$key = ?";
            $attributes[] = htmlentities($value, ENT_QUOTES);
        }
        $sql_part = implode(',', $sql_parts);

        return $this->query("INSERT INTO {$this->table} SET {$sql_part}", $attributes, null, true);
    }

    public function extract($key, $value)
    {
        $records = $this->all();
        $return = [];
        foreach($records as $v)
        {
            $return[$v->$key] = $v->$value;
        }
        return $return;
    }

    public function delete($id)
    {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], null, true);
    }
}
