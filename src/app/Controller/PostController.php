<?php

namespace App\Controller;
use Core\Html\Form;

class PostController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('post');
        $this->loadModel('comment');
    }

    public function index()
    {
        $posts = $this->post->all();
        $this->render('post.index', compact('posts'));
    }

    public function category()
    {
        $posts = $this->post->allinCategory($_GET['id']);
        if($posts) {
            $this->render('post.category', compact('posts'));
        }
        else
        {
            header('Location: ?p=error.notfound');
            die();
        }
    }
    public function show()
    {
        $post = $this->post->find($_GET['id']);
        if($post)
        {
            $comments = $this->comment->findAll($post->id);
            $form = new Form($_POST);
            $this->setTitle($post->name);
            $this->render('post.post', compact('post', 'form', 'comments'));
        }
        else
        {
            header('Location: ?p=error.notfound');
            die();
        }
    }
}