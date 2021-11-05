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
        $this->loadModel('status');
    }

    public function index()
    {
        $posts = $this->post->all();
        $this->render('admin.post.index', compact('posts'));
    }

    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->post->create([
                'name' => $_POST['name'], 
                'content' => $_POST['content'],
                'creation_date' => date("Y-m-d H:i:s"),
                'post_category' => $_POST['post_category'],
                'post_status' => $_POST['post_status'],
                'post_user' => $_SESSION['user_id'] 
            ]);
            if ($result) {
                header('Location: ?p=admin.post.index');
            }
        }   
        $categories = $this->category->extract('id', 'name');
        $status = $this->status->extract('id', 'name');
        $form = new Form($_POST);
        $this->render('admin.post.edit', compact('form', 'categories', 'status'));
    }

    public function edit()
    {
        if (!empty($_POST)) {
            $result = $this->post->update($_GET['id'],[
                'name' => $_POST['name'], 
                'content' => $_POST['content'], 
                'post_category' => $_POST['post_category'],
                'post_status' => $_POST['post_status']
            ]);
            if ($result) {
                header('Location: ?p=admin.post.index');
            }
        }
        $post = $this->post->find($_GET['id']);
        $categories = $this->category->extract('id', 'name');
        $status = $this->status->extract('id', 'name');
        $form = new Form($post);
        $this->render('admin.post.edit', compact('post', 'categories', 'status', 'form'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->post->delete($_POST['id']);
            if ($result) {
                header('Location: ?p=admin.post.index');
                $_SESSION['flash']['success'] = "L'article a bien été supprimé";
            }
        }
    }
}