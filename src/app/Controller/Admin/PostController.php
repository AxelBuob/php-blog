<?php

namespace App\Controller\Admin;

use Core\Html\Form;

class PostController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('post');
        $this->loadModel('category');
    }

    public function index()
    {
        $posts = $this->post->all();
        $this->render('admin.post.index', compact('posts'));
    }

    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->post->create(['name' => $_POST['name'], 'content' => $_POST['content'], 'post_category' => $_POST['post_category']]);
            if ($result) {
                header('Location: ?p=admin.post.index');
            }
        }   
        $categories = $this->category->extract('id', 'name');
        $form = new Form($_POST);
        $this->render('admin.post.edit', compact('form', 'categories'));
    }

    public function edit()
    {
        if (!empty($_POST)) {
            $result = $this->post->update($_GET['id'], ['name' => $_POST['name'], 'content' => $_POST['content'], 'post_category' => $_POST['post_category']]);
            if ($result) {
                header('Location: ?p=admin.post.index');
            }
        }
        $post = $this->post->findwithCategory($_GET['id']);
        $categories = $this->category->extract('id', 'name');
        $form = new Form($post);
        $this->render('admin.post.edit', compact('post', 'categories', 'form'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->post->delete($_POST['id']);
            if ($result) {
                header('Location: ?p=admin.post.index');
            }
        }
    }
}