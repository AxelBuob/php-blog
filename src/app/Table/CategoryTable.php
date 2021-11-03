<?php

namespace App\Table;

class CategoryTable extends \Core\Table\Table
{
    public function find($id)
    {
        return $this->query(
            "SELECT *
            FROM category
            WHERE category.id = ?
            ",
            [$id],
            null,
            true
        );
    }
}
