<?php
namespace App\Controller;

class ErrorController extends AppController
{
    public function notfound()
    {
        header("HTTP/1.0 404 Not Found");
        $this->render('error.404');
    }

    public function forbidden()
    {
        header("HTTP/1.0 403 Forbidden");
        $this->render('error.403');
    }
}
