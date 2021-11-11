<?php

namespace App\Controller\Admin;

class AppController extends \App\Controller\AppController
{
    protected $template;
    
    public function __construct()
    {
        parent::__construct();
        if(!$this->auth->isAdmin())
        {
            header('Location: /portofolio/error/forbidden/');
        }
    }

}
