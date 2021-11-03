<?php

namespace App\Table;

class FormationTable extends \Core\Table\Table
{
    public function find($id)
    {
        return $this->query(
            "SELECT * 
            FROM formation
            WHERE id = ?",
            [$id],
            null,
            true
        );
    }

    public function all()
    {
        return $this->query(
            "SELECT * 
            FROM formation",
            null,
            null,
            false
        );
    }
}
