<?php

namespace App\Table;

class ImageTable extends \Core\Table\Table
{
    protected $table = 'image';

    // public function find($id)
    // {
    //     return $this->query(
    //         "SELECT * 
    //         FROM image
    //         WHERE id = ?",
    //         [$id],
    //         null,
    //         true
    //     );
    // }
    // public function all()
    // {
    //     return $this->query(
    //         "SELECT * 
    //         FROM image",
    //         null,
    //         null,
    //         false
    //     );
    // }

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
