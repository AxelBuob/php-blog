<?php

namespace App\Table;

class SiteTable extends \Core\Table\Table
{
    protected $table = 'site';

    public function find($id)
    {
        return $this->query(
            "SELECT site.id, site.name, site.description, site.charset, site.language, site.site_logo, 
            user.twitter, user.linkedin, user.github,
            image.id AS logo_id, image.path AS logo_path, image.dir AS logo_dir 
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
