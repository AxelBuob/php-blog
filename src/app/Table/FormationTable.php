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
            "SELECT name, school, postcode, city, DATE_FORMAT(start_date, '%M %Y') as start_date, DATE_FORMAT(end_date, '%M %Y') as end_date
            FROM formation",
            null,
            null,
            false
        );
    }
}
