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
        return '?p=post.category&id=' . $this->post_category;
    }

    public function getGithub()
    {
        return 'http://github.com/axelbuob/';
    }

    public function getUser()
    {
        return '?p=user.show&id=' . $this->post_user;
    }
}