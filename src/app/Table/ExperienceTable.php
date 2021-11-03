<?php

namespace App\Table;

class ExperienceTable extends \Core\Table\Table
{
    public function find($id)
    {
        return $this->query(
            "SELECT * 
            FROM experience
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
            FROM experience",
            null,
            null,
            false
        );
    }
}
