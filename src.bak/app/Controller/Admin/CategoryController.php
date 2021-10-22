<?php

namespace App\Controller\Admin;

use Core\Html\Form;

class CategoryController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('post');
        $this->loadModel('category');
    }

    public function index()
    {
        $categories = $this->category->all();
        $this->render('admin.category.index', compact('categories'));
    }

    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->category->create(['name' => $_POST['name']]);
            if ($result) {
                header('Location: ?p=admin.category.index');
            }
        }
        $form = new Form($_POST);
        $this->render('admin.category.edit', compact('form'));
    }

    public function edit()
    {
        if (!empty($_POST)) {
            $result = $this->category->update($_GET['id'], ['name' => $_POST['name']]);
            if ($result) {
                header('Location: ?p=admin.category.index');
            }
        }

        $category = $this->category->find($_GET['id']);
        $form = new Form($category);
        $this->render('admin.category.edit', compact('category', 'form'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->category->delete($_POST['id']);
            if ($result) {
                header('Location: ?p=admin.category.index');
            }
        }
    }
}
