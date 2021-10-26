<?php

namespace App\Table;

class CommentTable extends \Core\Table\Table
{
    public function findAll($post_id)
    {   
        return $this->query(
            "SELECT comment.id, comment.content,
            DATE_FORMAT(comment.creation_date, '%d %M %Y') AS creation_date,
            DATE_FORMAT(comment.update_date, '%d %M %Y') AS update_date,
            comment.comment_post, comment.comment_user, comment.comment_status,
            user.first_name, user.last_name
            FROM comment 
            LEFT JOIN user
                ON comment.comment_user = user.id
            WHERE comment_post = ? AND comment.comment_status = 3"
        , [$post_id], get_called_class(), false
        );
    }
}
