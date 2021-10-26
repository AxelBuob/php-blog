<?php
namespace Core\Table;

use Core\Database\MysqlDatabase;

class Table
{

    protected $table;
    protected $db;

    public function __construct(MysqlDatabase $db)
    {
        $this->db = $db;
        if($this->table === null)
        {
            $class_name = explode('\\', get_called_class());
            $class_name = end($class_name);
            $class_name = str_replace('Table', '', $class_name);
            $class_name = strtolower($class_name);
            $this->table = $class_name;
        }
    }

    public function getDB()
    {
        return $this->db;
    }

    public function query($statement, $attributes, $class_name, $unique)
    {
        if($attributes === null)
        {
            return $this->db->query($statement,str_replace('Table', 'Entity', get_called_class()), $unique);
        }
        else
        {
            return $this->db->prepare($statement, $attributes, str_replace('Table', 'Entity', get_called_class()), $unique);
        }
    }

    public function all()
    {
        return $this->query("SELECT * FROM " .$this->table, null, str_replace('Table', 'Entity', get_called_class()), false);
    }

    public function find($id)
    {
        return $this->query("SELECT * FROM " . $this->table . " WHERE id = ?", [$id], str_replace('Table', 'Entity', get_called_class()), true);
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
            $attributes[] = $value;
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