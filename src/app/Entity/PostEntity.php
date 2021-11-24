<?php

namespace App\Entity;

class PostEntity extends \Core\Entity\Entity
{
    public function getUrl()
    {
        return '/portofolio/post/show/?id='. $this->id;
    }

    public function getCategory()
    {
        return '/portofolio/post/category/?id=' . $this->post_category;
    }

    public function getUser()
    {
        return '/portofolio/user/show/?id=' . $this->post_user;
    }
}
