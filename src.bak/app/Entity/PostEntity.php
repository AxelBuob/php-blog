<?php

namespace App\Entity;

class PostEntity extends \Core\Entity\Entity
{
    public function getUrl()
    {
        return '?p=post.show&id='. $this->id;
    }

    public function getExcerpt()
    {
        if (strlen($this->content > 250)) {
            $this->excerpt = substr($this->content, 0, 250) . '...';
        } else {
            $this->excerpt = $this->content;
        }
        return $this->excerpt;
    }

    public function getCategory()
    {
        return '?p=category&id=' . $this->category_id;
    }
}