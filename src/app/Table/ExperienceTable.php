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
            "SELECT name, company, postcode, city, DATE_FORMAT(start_date, '%M %Y') as start_date, DATE_FORMAT(end_date, '%M %Y') as end_date
            FROM experience",
            null,
            null,
            false
        );
    }
}
