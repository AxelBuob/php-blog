<?php

namespace App\Controller\Admin;

use Core\Html\Form;

class InterestController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('interest');
    }

    public function index()
    {
        $interests = $this->interest->all();
        $this->render('admin.interest.index', compact('interests'));
    }

    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->interest->create(['name' => $_POST['name']]);
            if ($result) {
                $_SESSION['flash']['success'] = "L'intérêts a bien été ajouté";
                header('Location: ?p=admin.interest.index');
            }
        }
        $form = new Form($_POST);
        $this->render('admin.interest.edit', compact('form'));
    }

    public function edit()
    {
        if (!empty($_POST)) {
            $result = $this->interest->update($_GET['id'], ['name' => $_POST['name']]);
            if ($result) {
                $_SESSION['flash']['success'] = "L'intérêt a bien été modifié";
                header('Location: ?p=admin.interest.index');
            }
        }

        $interest = $this->interest->find($_GET['id']);
        $form = new Form($interest);
        $this->render('admin.interest.edit', compact('interest', 'form'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->interest->delete($_POST['id']);
            if ($result) {
                $_SESSION['flash']['success'] = "L'intérêt a bien été supprimé";
                header('Location: ?p=admin.interest.index');
            }
        }
    }
}
