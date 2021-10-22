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
}