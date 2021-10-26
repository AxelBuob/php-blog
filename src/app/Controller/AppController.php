<?php

namespace App\Controller;
use App\Factory;

class AppController extends \Core\Controller\Controller
{
    protected $template;
    protected $viewPath;
    protected $title = 'Axel Buob | Développeur PHP/Symphony';

    public function __construct()
    {
        parent::__construct();
        $this->viewPath = ROOT . '/src/app/view/'; 
        $this->template = 'default'; 
    }


}