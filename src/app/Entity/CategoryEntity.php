<?php

namespace App\Entity;

class CategoryEntity extends \Core\Entity\Entity
{
    public function getUrl()
    {
        return '?p=post.category&id=' . $this->id;
    }

}
