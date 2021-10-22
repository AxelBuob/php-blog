<?php

namespace App\Table;

class PostTable extends \Core\Table\Table
{

    public function last()
    {
        return $this->query(
            "SELECT post.id, post.name, post.content, DATE_FORMAT(post.creation_date, '%d %M %Y') AS creation_date, category.id AS category_id, category.name AS category_name
            FROM post 
            LEFT JOIN category 
                ON post.post_category = category.id
            ORDER BY post.creation_date DESC",
            null,
            get_called_class(),
            false
        );
    }

    public function find($post_id)
    {
        return $this->query(
            "SELECT post.id, post.name, post.content, DATE_FORMAT(post.creation_date, '%d %M %Y') AS creation_date, category.id AS category_id,  category.name AS category_name
            FROM post
            LEFT JOIN category
                ON post.post_category = category.id
            WHERE post.id = ?
            ",
            [$post_id],
            get_called_class(),
            true
        );
    }


    public function lastByCategory($category_id)
    {
        return $this->query(
            "SELECT post.id, post.name, post.content, DATE_FORMAT(post.creation_date, '%d %M %Y') AS creation_date, category.id AS category_id,  category.name AS category_name
            FROM post
            LEFT JOIN category
                ON post.post_category = category.id
            WHERE post_category = ?
            ORDER BY post.creation_date DESC",
            [$category_id],
            get_called_class(),
            false
        ); 
    }
}