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
        $post_number = $this->post->count();
        $post_number = (int) $post_number->post;
        $page_number = ($_GET['p']) ?? 1;
        if(!filter_var($page_number, FILTER_VALIDATE_INT))
        {
            header('Location: /portofolio/error/notfound');
            exit();
        }
        $current_page = (int) $page_number;
        $post_per_page = 6;
        $pages = ceil($post_number / $post_per_page);
        $offset = $post_per_page * ($current_page - 1);

        if($current_page > $pages)
        {
            header('Location: /portofolio/error/notfound');
            exit();
        }
        $posts = $this->post->paginate($post_per_page, $offset);
        $this->render('post.index', compact('posts', 'current_page', 'pages'));
    }

    public function category()
    {
        $posts = $this->post->allinCategory($_GET['id']);
        if($posts) {
            $this->render('post.category', compact('posts'));
        }
        else
        {
            header('Location: /portofolio/error/notfound');
            exit();
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
            header('Location: /portofolio/error/notfound');
            exit();
        }
    }
}