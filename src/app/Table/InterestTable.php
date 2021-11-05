<?php

namespace App\Table;

class InterestTable extends \Core\Table\Table
{
    public function find($id)
    {
        return $this->query(
            "SELECT * 
            FROM interest
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
            FROM interest",
            null,
            null,
            false
        );
    }
}
