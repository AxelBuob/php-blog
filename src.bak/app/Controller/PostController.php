<?php

namespace App\Controller;

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
        $categories = $this->category->all();
        $posts = $this->post->last();
        $message = null;
        $this->render('post.index', compact('posts', 'categories'));
    }
    public function category()
    {
        $posts = $this->post->lastByCategory($_GET['id']);
        $categories = $this->category->all();
        $category_name = $this->category->find($_GET['id']);
        if ($category_name === false) {
            $controller = new ErrorController;
            $controller->notFound();
        }
        $this->setTitle($category_name->name);
        $this->render('post.category', compact('posts', 'categories','category_name'));
    }
    public function show()
    {
        $post = $this->post->find($_GET['id']);
        if($post === false)
        {
            $controller = new ErrorController;
            $controller->notFound();
        }
        $categories = $this->category->all();
        $category = $this->category->find($post->id);
        $this->setTitle($post->name);
        $this->render('post.post', compact('post', 'categories', 'category'));
    }
}