<?php

namespace App\Table;

class SkillTable extends \Core\Table\Table
{
    public function find($id)
    {
        return $this->query(
            "SELECT * 
            FROM skill
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
            FROM skill",
            null,
            null,
            false
        );
    }
}
