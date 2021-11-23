<?php

namespace App\Table;

class FormationTable extends \Core\Table\Table
{
    protected $table = 'formation';

    public function all()
    {
        return $this->query(
            "SELECT id, name, school, postcode, city, DATE_FORMAT(start_date, '%M %Y') as start_date, DATE_FORMAT(end_date, '%M %Y') as end_date
            FROM formation",
            null,
            null,
            false
        );
    }
}
