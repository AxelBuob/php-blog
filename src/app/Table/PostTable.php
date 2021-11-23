<?php

namespace App\Table;

class PostTable extends \Core\Table\Table
{
    protected $table = 'post';
    protected $entity = '\App\Entity\PostEntity';

    public function count()
    {
        return $this->query("SELECT COUNT(id) AS post FROM post", null, null, true);
    }

    public function find($id)
    {
        return $this->query(
            "SELECT post.id, post.name, post.content, DATE_FORMAT(post.creation_date, '%W %d %b, %Y') AS creation_date, 
            post.post_status, post.post_category, post.post_user,
            category.name AS category_name , 
            CONCAT(user.first_name, ' ', user.last_name) AS user_name, 
            image.id AS image_id, image.path AS image_path, image.dir AS image_dir,
            status.name AS status_name
            FROM post
            LEFT JOIN category
                ON post.post_category = category.id
            LEFT JOIN user
                ON post.post_user = user.id
            LEFT JOIN status
                ON post.post_status = status.id
            LEFT JOIN image
                    on post.post_image = image.id
            WHERE post.id = ?
            ",
            [$id],
            $this->entity,
            true
        );
    }

    public function paginate($limit, $offset)
    {
        return $this->query(
            "SELECT post.id, post.name, post.content, DATE_FORMAT(post.creation_date, '%W %d %b, %Y') AS creation_date, 
            post.post_status, post. post_category, post.post_user,
            category.name AS category_name, 
            CONCAT(user.first_name, ' ', user.last_name) AS user_name,
            status.name AS status_name,
            image.path AS image 
            FROM post
            LEFT JOIN category
                ON post.post_category = category.id
            LEFT JOIN user
                ON post.post_user = user.id
            LEFT JOIN status
                ON post.post_status = status.id 
            LEFT JOIN image
                on post.post_image = image.id
            ORDER BY post.creation_date DESC
            LIMIT $limit
            OFFSET $offset",
            null,
            $this->entity,
            false
        );
    }

    public function all()
    {
        return $this->query(
            "SELECT post.id, post.name, post.content, DATE_FORMAT(post.creation_date, '%W %d %b, %Y') AS creation_date, 
            post.post_status, post. post_category, post.post_user,
            category.name AS category_name , 
            CONCAT(user.first_name, ' ', user.last_name) AS user_name,
            status.name AS status_name 
            FROM post
            LEFT JOIN category
                ON post.post_category = category.id
            LEFT JOIN user
                ON post.post_user = user.id
            LEFT JOIN status
                ON post.post_status = status.id 
            ORDER BY post.creation_date DESC",
            null,
            $this->entity,
            false
        );
    }

    public function allinCategory($category_id)
    {
        return $this->query(
            "SELECT post.id, post.name, post.content, DATE_FORMAT(post.creation_date, '%W %d %b, %Y') AS creation_date,
            post.post_category, post.post_user, post.post_status, 
            category.name AS category_name , 
            CONCAT(user.first_name, ' ', user.last_name) AS user_name,
            status.name AS status_name 
            FROM post
            LEFT JOIN category
                ON post.post_category = category.id
            LEFT JOIN user
                ON post.post_user = user.id
            LEFT JOIN status
                ON post.post_status = status.id 
            WHERE post_category = ?
            ORDER BY post.creation_date DESC",
            [$category_id],
            $this->entity,
            false
        ); 
    }
}