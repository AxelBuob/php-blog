<?php

namespace App\Controller;

class AppController extends \Core\Controller\Controller
{
    protected $template;
    protected $viewPath;
    protected $title = 'Axel Buob | Développeur PHP/Symphony';
    protected $upload_path;

    public function __construct()
    {
        parent::__construct();
        $this->viewPath = ROOT . '/src/app/View/'; 
        $this->template = 'default';
        $this->upload_path = './uploads/';
    }
}