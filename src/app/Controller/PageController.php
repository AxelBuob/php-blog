<?php
namespace App\Controller;
use Core\Html\Form;
use Core\Mail\Mail;

class PageController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function contact()
    {

        $form = new Form();
        $this->render('page.contact', compact('form'));
    }

    public function resume()
    {
        $this->render('page.resume');
    }
}