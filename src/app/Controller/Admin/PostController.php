<?php

namespace App\Controller\Admin;

use Core\Html\Form;
use App\Controller\Admin\ImageController;

class PostController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('post');
        $this->loadModel('category');
        $this->loadModel('status');
        $this->loadModel('image');
    }

    public function index()
    {
        $posts = $this->post->all();
        $this->render('admin.post.index', compact('posts'));
    }

    public function add()
    {
        $categories = $this->category->extract('id', 'name');
        $status = $this->status->extract('id', 'name');
        $form = new Form($_POST);

        if (!empty($_POST)) {
            if (is_array($_FILES['image']) && $_FILES['image']['tmp_name'])
            {
                $image = new ImageController();
                if($image->add($_FILES['image']))
                {
                    $image = new ImageController();
                    $image_last_insert_id = $image->add($_FILES['image']);
                }
            }
            $create_post = $this->post->create([
                'name' => $_POST['name'], 
                'content' => $_POST['content'],
                'creation_date' => date("Y-m-d H:i:s"),
                'post_category' => $_POST['post_category'],
                'post_status' => $_POST['post_status'],
                'post_user' => $_SESSION['user_id'],
                'post_image' => $image_last_insert_id
            ]);
            if ($create_post) {
                header('Location: /portofolio/admin/post/');
                throw new \Exception();;
            }
        }   
        
        
        $this->render('admin.post.edit', compact('form', 'categories', 'status'));
    }

    public function edit()
    {
        $post = $this->post->find($_GET['id']);
        $categories = $this->category->extract('id', 'name');
        $status = $this->status->extract('id', 'name');
        $form = new Form($post);
        
        if (!empty($_POST)) {
            if (is_array($_FILES['image']) && $_FILES['image']['tmp_name'])
            {
                $image = new ImageController();
                if($post->image_id !== null)
                {
                    $this->post->update($_GET['id'],['post_image' => null]);
                    $image->delete($post->image_id);
                    $image_last_insert_id = $image->add($_FILES['image']);
                }
                else
                {
                    $image_last_insert_id = $image->add($_FILES['image']);
                }
            }
            $update_post = $this->post->update($_GET['id'],[
                'name' => $_POST['name'], 
                'content' => $_POST['content'], 
                'post_category' => $_POST['post_category'],
                'post_status' => $_POST['post_status'],
                'post_image' => $image_last_insert_id
                
            ]);
            if ($update_post) {
                $_SESSION['flash']['success'] = 'Article mis à jour avec succès';
                header('Location: /portofolio/admin/post/edit/?id='.$post->id);
                throw new \Exception();;
            }
        }
        $this->render('admin.post.edit', compact('post', 'categories', 'status', 'form'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->post->delete($_POST['id']);
            if ($result) {
                $_SESSION['flash']['success'] = "L'article a bien été supprimé";
                header('Location: /portofolio/admin/post/');
                throw new \Exception();;
            }
        }
    }
}