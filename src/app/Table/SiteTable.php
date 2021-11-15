<?php

namespace App\Table;

class SiteTable extends \Core\Table\Table
{
    public function find($id)
    {
        return $this->query(
            "SELECT site.id, site.description, site.charset, site.language, 
            user.twitter, user.linkedin, user.github,
            image.path AS logo
            FROM site
            LEFT JOIN user
                ON site.site_user = user.id 
            LEFT JOIN image
                ON site.site_logo = image.id 
            WHERE site.id = ?",
            [$id],
            null,
            true
        );
    }
}
