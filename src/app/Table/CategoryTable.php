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
            get_called_class(),
            true
        );
    }
}
