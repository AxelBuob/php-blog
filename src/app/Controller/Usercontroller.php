<?php

namespace App\Controller;

use Core\Html\Form;
use Core\Auth\Auth;

class UserController extends AppController
{
    protected $auth;

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('user');
        $this->auth = new Auth(\App\Factory::getFactory()->getDB());
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

    public function signout()
    {
        $_SESSION = [];
        session_destroy();
        $_SESSION['flash']['success'] = 'Vous avez bien été déconnecté !';
        header('Location: ?p=post.index');
        die();
    }

}
