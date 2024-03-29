<?php

namespace App\Table;

class ImageTable extends \Core\Table\Table
{
    protected $table = 'image';

    public function findPostId($id)
    {
        return $this->query(
            "SELECT * 
            FROM image
            WHERE image_post = ?",
            [$id],
            null,
            true
        ); 
    }

}
