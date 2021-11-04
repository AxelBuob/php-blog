<?php

namespace App\Table;

class SiteTable extends \Core\Table\Table
{
    public function find($id)
    {
        return $this->query(
            "SELECT * 
            FROM site
            WHERE id = ?",
            [$id],
            null,
            true
        );
    }
}
