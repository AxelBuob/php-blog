<?php

namespace App\Controller;

class AppController extends \Core\Controller\Controller
{
    protected $template;
    protected $viewPath;
    protected $upload_path;

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('user');

        $this->viewPath = ROOT . '/src/app/view/'; 
        $this->template = 'default';
    }
}