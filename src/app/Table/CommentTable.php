<?php

namespace App\Table;

class CommentTable extends \Core\Table\Table
{

    public function all()
    {
        return $this->query(
            "SELECT comment.id, DATE_FORMAT(comment.creation_date, '%d/%m/%y à %h:%m') AS creation_date, 
            comment.comment_status, comment.comment_user, comment.comment_post, 
            status.name AS status_name,
            user.email AS user_email,
            post.name AS post_name 
            FROM comment
            LEFT JOIN status 
                ON comment.comment_status = status.id 
            LEFT JOIN user
                ON comment.comment_user = user.id
            LEFT JOIN post
                ON comment.comment_post = post.id
            ORDER by comment.creation_date DESC"
        ,null, null, false);
    }

    public function find($id)
    {
        return $this->query(
            "SELECT comment.id AS comment_id, DATE_FORMAT(comment.creation_date, '%d %M %Y à %h:%m:%s') AS creation_date, 
            comment.content, comment.comment_user, comment.comment_status, 
            user.email AS user_email, CONCAT(user.first_name, ' ', user.last_name) AS user_name
            FROM comment 
            LEFT JOIN user 
             ON comment.comment_user = user.id
            WHERE comment.id = ?"
        , [$id], null, true);
    }

    public function findAll($post_id)
    {   
        return $this->query(
            "SELECT comment.id, comment.content,
            DATE_FORMAT(comment.creation_date, '%W %d %b, %Y') AS creation_date, comment.comment_post AS post_id,
            comment.comment_status AS status_id, status.name AS status_name, 
            comment.comment_user AS user_id, CONCAT(user.first_name, ' ',user.last_name) AS user_name
            FROM comment 
            LEFT JOIN user
                ON comment.comment_user = user.id
            LEFT JOIN status 
                ON comment_status = status.id
            WHERE comment_post = ? AND comment.comment_status = 3"
        , [$post_id], null, false);
    }
}
