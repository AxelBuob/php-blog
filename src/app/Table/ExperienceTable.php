<?php

namespace App\Table;

class ExperienceTable extends \Core\Table\Table
{
    protected $table = 'experience';

    public function all()
    {
        return $this->query(
            "SELECT id, name, company, postcode, city, DATE_FORMAT(start_date, '%M %Y') as start_date, DATE_FORMAT(end_date, '%M %Y') as end_date
            FROM experience",
            null,
            null,
            false
        );
    }
}
