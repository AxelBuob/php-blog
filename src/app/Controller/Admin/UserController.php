<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Core\Html\Form;
use Core\Auth\Auth;

class UserController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('user'); 
        $this->loadModel('role');
        $this->auth = new Auth();
    }

    public function index()
    {
        $users = $this->user->all();
        $this->render('admin.user.index', compact('users'));
    }

    public function edit()
    {
        if (!empty($_POST)) {
            $result = $this->user->update($_GET['id'], [
                'email' => $_POST['email'],
                'password' => $this->auth->hashPassword($_POST['password']),
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'user_role' => $_POST['user_role']
            ]);
            if ($result) {
                $_SESSION['flash']['success'] = "L'utilisatateur a bien été modifié.";
                header('Location: /portofolio/admin/user/');
                exit();
            }
        }
        $user = $this->user->find($_GET['id']);
        $roles = $this->role->extract('id', 'name');
        $form = new Form($user);
        $this->render('admin.user.edit', compact('user', 'form', 'roles'));
    }

    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->user->create([
                'email' => $_POST['email'],
                'password' => $this->auth->hashPassword($_POST['password']),
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'user_role' => $_POST['user_role']

            ]);
            if ($result) {
                $_SESSION['flash']['success'] = "L'utilisatateur a bien été ajouté.";
                header('Location: /portofolio/admin/user/');
                exit();
            }
        }
        $roles = $this->role->extract('id', 'name');
        $form = new Form($_POST);
        $this->render('admin.user.edit', compact('form', 'roles'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->user->delete($_POST['id']);
            if ($result) {
                $_SESSION['flash']['success'] = "L'utilisatateur a bien été supprimé.";
                header('Location: /portofolio/admin/user/');
                exit();
            }
        }
    }
}