<?php
namespace App\Controller;
use Core\Html\Form;
use Core\Mail\Mail;
use \Mpdf\Mpdf;

class PageController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('skill');
        $this->loadModel('formation');
        $this->loadModel('experience');
        $this->loadModel('interest');
        $this->loadModel('user');
        $this->loadModel('site');
    }

    public function contact()
    {
        if(!empty($_POST))
        {
            if (empty($_POST['name']))
            {
                $_SESSION['flash']['error'] = 'Veuillez renseigner votre nom';
            }    
            elseif (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $_SESSION['flash']['error'] = 'Veuillez renseigner un email valide';
            } 
            elseif (empty($_POST['subject']))
            {
                $_SESSION['flash']['error'] = 'Veuillez renseigner le sujet de votre message';
            } 
            elseif (empty($_POST['message']))
            {
                $_SESSION['flash']['error'] = 'Veuillez renseigner votre message';
            }
            else
            {
                $to = 'contact@axelbuob.fr';
                $subject = $_POST['subject'];
                $message = $_POST['message'];
                $from = $_POST['from'];
                $mail = new Mail($to, $from, $subject, $message);
                $mail->send();
                $_SESSION['flash']['success'] = 'Merci votre email a bien été envoyé';
                header('Location: /portofolio/');
                throw new \Exception();
            }
        }
        $form = new Form();
        $this->setTitle('Contact');
        $this->render('page.contact', compact('form'));
    }

    public function resume()
    {
        $skills = $this->skill->all();
        $experiences = $this->experience->all();
        $formations = $this->formation->all();
        $interests = $this->interest->all();
        $author = $this->user->find('1');
        
        if (isset($_GET['download'])) {
            $mpdf = new Mpdf();
            ob_start();            
            require($this->viewPath . '/page/resume-print.php');
            $content = ob_get_clean();
            $mpdf->WriteHTML($content);
            $mpdf->Output();
        }
        else
        {
            $this->setTitle('CV');
            $this->render('page.resume',compact('skills','experiences','formations','interests','author'));  
        }

    }
}
