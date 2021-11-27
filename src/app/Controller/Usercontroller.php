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
            header('Location: /portofolio/');
            throw new \Exception();;
        }

        if(!empty($_POST))
        {
            $user = $this->user->findUserEmail($_POST['email']);
            if($user && $this->auth->checkPassword($_POST['password'], $user->password))
            {
                if($user->confirmed_at === null)
                {
                    $_SESSION['flash']['danger'] = 'Merci de confirmer devez confirmer votre email';
                    header('Location: /portofolio/user/signin');
                    throw new \Exception();;
                }
                else
                {
                        $_SESSION['user_id'] = $user->id;
                        $_SESSION['user_role'] = $user->user_role;
                        $_SESSION['flash']['success'] = 'Vous avez bien été connecté !';
                        header('Location: /portofolio/');
                        throw new \Exception();;
                }
            }
            else
            {
                $_SESSION['flash']['danger'] = 'Mauvais mot de passe ou email !';
                header('Location: /portofolio/user/signin');
                throw new \Exception();;
            }
        }
        $form = new Form;
        $this->render('user.signin', compact('form'));
        
    }



    public function signup()
    {

        if ($this->auth->logged()) {
            header('Location: /portofolio/');
            throw new \Exception();;
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
            elseif(strlen($_POST['password']) < 8 || !$this->password_strength_check($_POST['password']))
            {
                $_SESSION['flash']['danger']  = 'Votre mot de passe doit contenir au moins 8 caractères, dont une lettre en capitale, un chiffre et un caractère spécial (!@#$%).';  
            }
            else 
            {
                $password = $this->auth->hashPassword($_POST['password']);
                $token = $this->auth->createToken();
                $result = $this->user->create([
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
                    $message .= 'http://localhost/portofolio/user/confirm/?id='. $id .'&token=' . $token;
                    $from = 'contact@axelbuob.fr';
                    $mail = new Mail($_POST['email'], $from, $subject, $message);
                    $mail->send();
                    $_SESSION['flash']['success'] = 'Un lien de confirmation vous a été envoyé par email';
                    header('Location: /portofolio');
                    throw new \Exception();;
                    
                }
            }
        }
        $form = new Form;
        $this->render('user.signup',compact('form'));
    }

    public function confirm()
    {
        $id = $_GET['id'];
        $token = $_GET['token'];
        $user = $this->user->find($id);
        if ($user && $user->confirmed_token === $token) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_role'] = $user->user_role;
            $req = $this->user->update($user->id, [
                'confirmed_token' => null,
                'confirmed_at' => date('Y-m-d H:i:s')
            ]);
            if ($req) {
                $_SESSION['flash']['success'] = 'Merci votre compte a bien été validé';
                header('Location: /portofolio/');
                throw new \Exception();;
            }
        } else {
            header('Location: /portofolio/error/forbidden');
            throw new \Exception();;
        }
    }

    public function signout()
    {
        $_SESSION = [];
        session_destroy();
        session_start();
        $_SESSION['flash']['success'] = 'Vous avez bien été déconnecté !';
        header('Location: /portofolio');
        throw new \Exception();;
    }

    public function show()
    {
        $user = $this->user->find($_GET['id']);
        if(isset($_GET['id']) && $user)
        {
            $this->render('user.show', compact('user'));
        }
        else
        {
            header('Location: /portofolio/error/notfound');
            throw new \Exception();;
        }
    }

    public function setting()
    {

        if(!$this->auth->logged() || $_SESSION['user_id'] !== $_GET['id']){
            header('Location: /portofolio/error/forbidden');
            throw new \Exception();;  
        }
        else
        {
            $char = "/^[a-zA-ZÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ\- \ .,]+$/";
            $url = "%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i";
            if (!empty($_POST)) {
                if(!empty($_POST['first_name']) && !preg_match($char, $_POST['first_name']))
                {
                    $_SESSION['flash']['warning']  = 'Veuillez renseigner un prénom valide';
                }
                elseif(!empty($_POST['last_name']) && !preg_match($char, $_POST['last_name']))
                {
                    $_SESSION['flash']['warning']  = 'Veuillez renseigner un nom valide';
                }
                elseif (!empty($_POST['about']) && strlen($_POST['about']) > '255')
                {
                    $_SESSION['flash']['warning']  = 'Maximum charactère 255';
                } 
                elseif (!empty($_POST['job']) && strlen($_POST['job']) > '255'&& !preg_match($char, $_POST['last_name']))
                {
                    $_SESSION['flash']['warning']  = 'Veuillez renseigner un job valide';
                }
                elseif (!empty($_POST['city']) && !preg_match($char, $_POST['city']))
                {
                    $_SESSION['flash']['warning']  = 'Veuillez renseigner un nom de ville valide';
                }
                elseif (!empty($_POST['twitter']) && !preg_match($url, $_POST['twitter']))
                {
                    $_SESSION['flash']['warning']  = 'Veuillez une adresse URL valide';
                }
                elseif (!empty($_POST['linkedin']) && !preg_match($url, $_POST['linkedin']))
                {
                    $_SESSION['flash']['warning']  = 'Veuillez renseigner une adresse URL valide';
                }
                elseif (!empty($_POST['github']) && !preg_match($url, $_POST['github']))
                {
                    $_SESSION['flash']['warning']  = 'Veuillez renseigner une adresse URL valide';
                }
                else
                {
                    $result = $this->user->update($_SESSION['user_id'],[
                        'first_name' => $_POST['first_name'],
                        'last_name' => $_POST['last_name'],
                        'job' => $_POST['job'],
                        'about' => $_POST['about'],
                        'city' => $_POST['city'],
                        'twitter' => $_POST['twitter'],
                        'linkedin' => $_POST['linkedin'],
                        'github' => $_POST['github']
                    ]);
                    if($result)
                    {
                        header('Location: /portofolio/user/setting/?id='.$_SESSION['user_id']);
                        throw new \Exception();;
                    }
                }
            }
            $user = $this->user->find($_SESSION['user_id']);
            $form = new Form($user);
            $this->render('user.setting', compact('user','form'));
        }
    }

    
    public function password()
    {
        if (!$this->auth->logged()) {
            header('Location: /portofolio/error/forbidden');
            throw new \Exception();;
        }
        if(!empty($_POST))
        {
            if(empty($_POST['password']) && !empty($_POST['password_confirm']))
            {
                $_SESSION['flash']['warning'] = 'Veuillez renseigner votre mot de passe';
            }
            elseif($_POST['password'] !== $_POST['password_confirm'])
            {
                $_SESSION['flash']['warning'] = 'Les deux mots de passe ne correspondent pas';
            }
            else
            {
                $result = $this->user->update($_SESSION['user_id'],[
                    'password' => $this->auth->hashPassword($_POST['password'])
                ]);
                if($result) {
                    $_SESSION['flash']['success'] = 'Votre mot de passe a bien été changé';
                    header('Location: /portofolio/user/setting/?id='.$_SESSION['user_id']);
                    throw new \Exception();;
                }
            }
        }
        $user = $this->user->find($_SESSION['user_id']);
        $form = new Form($user);
        $this->render('user.password', compact('form', 'user')); 
    }

    public function forget()
    {
        if ($this->auth->logged()) {
            header('Location: /portofolio/user/signin');
            throw new \Exception();;
        }
        if(!empty($_POST))
        {  
            if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $_SESSION['flash']['danger']  = 'Veuillez renseigner un email valide';
                
            }
            else
            {
                $user = $this->user->findUserEmail($_POST['email']);
                if(!$user)
                {
                    $_SESSION['flash']['warning']  = 'Aucun compte ne correspond à cet email';  
                }
                else
                {
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
                        $message .= 'http://localhost/portofolio/user/reset/?id=' . $id . '&token=' . $token;
                        $from = 'contact@axelbuob.fr';
                        $mail = new Mail($user->email, $from, $subject, $message);
                        $mail->send();
                        $_SESSION['flash']['success'] = 'Un lien de réinitialisation de mot de passe vous a été envoyé par email';
                        header('Location: /portofolio');
                        throw new \Exception();;
                    }
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
            header('Location: /portofolio/error/notfound');
            throw new \Exception();;
        }
        else
        {
            if (!empty($_POST)) {
                if (empty($_POST['password']) && !empty($_POST['password_confirm']))
                {
                    $_SESSION['flash']['warning'] = 'Veuillez renseigner votre mot de passe';
                }
                elseif ($_POST['password'] !== $_POST['password_confirm'])
                {
                    $_SESSION['flash']['warning'] = 'Les deux mots de passe ne correspondent pas';
                }
                elseif (strlen($_POST['password']) < 8 || !$this->password_strength_check($_POST['password']))
                {
                    $_SESSION['flash']['danger']  = 'Votre mot de passe doit contenir au moins 8 caractères, dont une lettre en capitale, un chiffre et un caractère spécial (!@#$%).';
                }
                else
                {
                    if (!$_GET['token'] === $user->reset_token) {
                        header('Location: /portofolio/error/forbidden');
                        throw new \Exception();;
                    } else {
                        $result = $this->user->update($_GET['id'], [
                            'password' => $this->auth->hashPassword($_POST['password']),
                            'reset_token' => null
                        ]);
                        if ($result) {
                            $_SESSION['flash']['success'] = 'Votre mot de passe a bien été réinitialisé';
                            header('Location: /portofolio/user/signin');
                            throw new \Exception();;
                        }
                    }
                }
            }
        }
       
        $form = new Form($user);
        $this->render('user.password', compact('form', 'user')); 
    }
    public function password_strength_check($password, $min_len = 8, $max_len = 70, $req_digit = 1, $req_lower = 1, $req_upper = 1, $req_symbol = 1)
    {
        // Build regex string depending on requirements for the password
        $regex = '/^';
        if ($req_digit == 1) {
            $regex .= '(?=.*\d)';
        }              // Match at least 1 digit
        if ($req_lower == 1) {
            $regex .= '(?=.*[a-z])';
        }           // Match at least 1 lowercase letter
        if ($req_upper == 1) {
            $regex .= '(?=.*[A-Z])';
        }           // Match at least 1 uppercase letter
        if ($req_symbol == 1) {
            $regex .= '(?=.*[^a-zA-Z\d])';
        }    // Match at least 1 character that is none of the above
        $regex .= '.{' . $min_len . ',' . $max_len . '}$/';

        if (preg_match($regex, $password)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
