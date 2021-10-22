<?php

namespace App\Controller;

use Core\Html\Form;
use Core\Auth\Auth;
use Core\Mail\Mail;

class UserController extends AppController
{
    protected $auth;

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('user');
        $this->auth = new Auth;
    }

    public function signin()
    {

        if($this->auth->logged())
        {
            header('Location: ?p=post.index');
            die();
        }

        if(!empty($_POST))
        {
            $user = $this->user->findUserEmail($_POST['email']);
            if($user)
            {
                if($user->confirmed_at === null)
                {
                    $_SESSION['flash']['danger'] = 'Vous devez confirmer votre email';
                    header('Location: ?p=user.signin');
                    die();
                }
                else
                {
                    if($this->auth->checkPassword($_POST['password'], $user->password))
                    {
                        $_SESSION['user_id'] = $user->id;
                        $_SESSION['user_role'] = $user->user_role;
                        $_SESSION['flash']['success'] = 'Vous avez bien été connecté !';
                        header('Location: index.php?p=post.index');
                        die();
                    }
                    else 
                    {
                        $_SESSION['flash']['danger'] = 'Mauvais mot de passe ou email !';
                        header('Location: index.php?p=user.signin');
                        die();
                    }
                }

            }
        }
        $form = new Form;
        $this->render('user.signin', compact('form'));
        
    }

    public function signup()
    {

        if ($this->auth->logged()) {
            header('Location: ?p=post.index');
            die();
        }

        if(!empty($_POST))
        {
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
            {
                $_SESSION['flash']['danger']  = 'Veuillez renseigner un email valide';
            } 
            elseif ($this->user->findUserEmail($_POST['email'])) 
            {
                $_SESSION['flash']['danger']  = "Email non disponible!";
            }
            elseif (empty($_POST['password']) || $_POST['password'] !== $_POST['password_confirm'])
            {
                $_SESSION['flash']['danger']  = 'Veuillez renseigner un mot de passe valide';
            }
            else 
            {
                $password = $this->auth->hashPassword($_POST['password']);
                $token = $this->auth->createToken();
                $result = $this->user->create([
                    'name' => $_POST['name'], 
                    'email' => $_POST['email'], 
                    'password' => $password,
                    'user_role' => '2', 
                    'confirmed_token' => $token
                ]);

                if($result)
                {
                    $id = $this->user->getDB()->lastInsertId();
                    $subject = 'Email de confirmation';
                    $message = 'Merci de confirmer votre email en vous rendant à cette adresse : ';
                    $message .= 'http://localhost/php-blog/src/index.php?p=user.confirm&id='. $id .'&token=' . $token;
                    $from = 'contact@axelbuob.fr';
                    $mail = new Mail($_POST['email'], $from, $subject, $message);
                    $mail->send();
                    $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé';
                    header('Location: ?p=user.signin');
                    die();
                    
                }
            }
        }
        $form = new Form;
        $this->render('user.signup',compact('form'));
        
    }

    public function signout()
    {
        $_SESSION = [];
        session_destroy();
        $_SESSION['flash']['success'] = 'Vous avez bien été déconnecté !';
        header('Location: ?p=post.index');
        die();
    }

    public function confirm()
    {
        $id = $_GET['id'];
        $token = $_GET['token'];
        $user = $this->user->find($id);
        if($user && $user->confirmed_token == $token) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_role'] = $user->user_role;
            $req = $this->user->update($user->id, [
                'confirmed_token' => null, 
                'confirmed_at' => date('Y-m-d H:i:s')]);
            if($req)
            {
                $_SESSION['flash']['success'] = 'Votre compte a bien été validé'; 
                header('Location: ?p=user.account');
                die();
                
            }
        }
        else
        {
            $_SESSION['flash']['danger'] = 'Mauvais token';
            header('Location: ?p=error.notfound');
            die();
            
        }
    }

    public function account()
    {
        if(!$this->auth->logged()){
            header('Location: ?p=user.signin');
            die();  
        }
        else
        {
            $char = "/^[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ\- \ .,]+$/";
            $url = "%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i";
            if (!empty($_POST)) {
                if(!empty($_POST['first_name']) && !preg_match($char, $_POST['first_name']))
                {
                    echo 'firstname pas ok';
                    //$_SESSION['flash']['error']  = 'Veuillez renseigner un prénom valide';
                }
                elseif(!empty($_POST['last_name']) && !preg_match($char, $_POST['last_name']))
                {
                    echo 'last_name pas ok';
                    //$_SESSION['flash']['error']  = 'Veuillez renseigner un nom valide';
                }
                elseif (!empty($_POST['about']) && strlen($_POST['about']) > '255')
                {
                    echo 'about pas ok';
                    //$_SESSION['flash']['error']  = 'Maximum charactère 255';
                }
                elseif (!empty($_POST['city']) && !preg_match($char, $_POST['city']))
                {
                    echo 'city pas ok';
                    //$_SESSION['flash']['error']  = 'Veuillez renseigner un nom valide';
                }
                elseif (!empty($_POST['twitter']) && !preg_match($url, $_POST['twitter']))
                {
                    echo 'twitter pas ok';
                    //$_SESSION['flash']['error']  = 'Veuillez renseigner un nom valide';
                }
                elseif (!empty($_POST['linkedin']) && !preg_match($url, $_POST['linkedin']))
                {
                    echo 'linkedin pas ok';
                    //$_SESSION['flash']['error']  = 'Veuillez renseigner un nom valide';
                }
                elseif (!empty($_POST['github']) && !preg_match($url, $_POST['github']))
                {
                    echo 'github pas ok';
                    //$_SESSION['flash']['error']  = 'Veuillez renseigner un nom valide';
                }
                else
                {
                    $result = $this->user->update($_SESSION['user_id'],[
                        'first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'about' => $_POST['about'],
                        'city' => $_POST['city'],
                        'twitter' => $_POST['twitter'],
                        'linkedin' => $_POST['linkedin'],
                        'github' => $_POST['github']
                    ]);
                    if($result)
                    {
                        header('Location: ?p=user.account');
                        die();
                    }
                }
            }
            $user = $this->user->find($_SESSION['user_id']);
            $form = new Form($user);
            $this->render('user.account', compact('form', 'user'));
        }
    }


    /**
     * Attention TOKEN
     *
     * @return void
     */
    
     public function password()
    {
        if (!$this->auth->logged()) {
            header('Location: ?p=user.signin');
            die();
        }
        if(!empty($_POST))
        {
            if(!empty($_POST['password']) && $_POST['password'] === $_POST['password_confirm'])
            {
                $result = $this->user->update($_SESSION['user_id'],[
                    'password' => $this->auth->hashPassword($_POST['password'])
                ]);
                if($result) {
                    $_SESSION['flash']['success'] = 'Votre mot de passe a bien été changé';
                    header('Location: ?p=user.account');
                    die();
                }
            }
        }
        $user = $this->user->find($_SESSION['user_id']);
        $form = new Form($user);
        $this->render('user.password', compact('form', 'user')); 
    }

    public function email()
    {
        if (!$this->auth->logged()) {
            header('Location: ?p=user.signin');
            die();
        }
        if (!empty($_POST)) {
            if (!empty($_POST['email']) && $_POST['email'] === $_POST['email_confirm']) {
                $token = $this->auth->createToken();
                $result = $this->user->update($_SESSION['user_id'], [
                    'email' => $_POST['email'],
                    'confirmed_token' => $token,
                    'confirmed_at' => null
                ]);
                if ($result) {
                    if ($result) {
                        $id = $_SESSION['user_id'];
                        $subject = 'Email de confirmation';
                        $message = 'Merci de confirmer votre email en vous rendant à cette adresse : ';
                        $message .= 'http://localhost/php-blog/src/index.php?p=user.confirm&id=' . $id . '&token=' . $token;
                        $from = 'contact@axelbuob.fr';
                        $mail = new Mail($_POST['email'], $from, $subject, $message);
                        $mail->send();
                        $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé';
                        header('Location: ?p=user.signin');
                        die();
                    }
                }
            }
        }
        $user = $this->user->find($_SESSION['user_id']);
        $form = new Form($user);
        $this->render('user.email', compact('form', 'user'));
    }

    public function forget()
    {
        if ($this->auth->logged()) {
            header('Location: ?p=user.signin');
            die();
        }
        if(!empty($_POST))
        {  
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash']['danger']  = 'Veuillez renseigner un email valide';
                
            }
            else
            {
                $user = $this->user->findUserEmail($_POST['email']);
                $token = $this->auth->createToken();
                $result = $this->user->update($user->id, [
                    'reset_token' => $token,
                    'reset_at' => date('Y-m-d H:i:s')
                ]);
                if($result)
                {
                    $id = $user->id;
                    $subject = 'Réinitialisation du mot de passe';
                    $message = 'Merci de vous rendre à cette adresse pour réinitialiser votre mot de passe :';
                    $message .= 'http://localhost/php-blog/src/index.php?p=user.reset&id=' . $id . '&token=' . $token;
                    $from = 'contact@axelbuob.fr';
                    $mail = new Mail($user->email, $from, $subject, $message);
                    $mail->send();
                    $_SESSION['flash']['success'] = 'Un lien de réinitialisation de mot de passe vous a été envoyé par email';
                    header('Location: ?p=user.signin');
                    die();
                }
            }
        }
        $form = new Form();
        $this->render('user.forget', compact('form'));
    }

    public function reset()
    {
        $user = $this->user->find($_GET['id']);
        if(!$user)
        {

        }
        else
        {
            if(!$_GET['token'] === $user->reset_token)
            {
                $_SESSION['flash']['danger'] = 'Mauvais token';
                header('Location: ?p=error.forbidden');
                die();
            }
            else
            {
                if (!empty($_POST)) {
                    if (!empty($_POST['password']) && $_POST['password'] === $_POST['password_confirm']) {
                        $result = $this->user->update($_GET['id'], [
                            'password' => $this->auth->hashPassword($_POST['password']),
                            'reset_token' => null,
                            'reset_at' => null
                        ]);
                        if ($result) {
                            $_SESSION['flash']['success'] = 'Votre mot de passe a bien été changé';
                            header('Location: ?p=user.account');
                            die();
                        }
                    }
                }
            }
        }
       
        $form = new Form($user);
        $this->render('user.password', compact('form', 'user')); 
    }
}
