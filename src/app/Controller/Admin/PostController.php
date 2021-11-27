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
        $this->loadModel('user');
        $this->loadModel('comment');
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
        $author = $this->user->extract('id', 'name');

        if (!empty($_POST)) {
            $create_post = $this->post->create([
                'name' => $_POST['name'], 
                'content' => $_POST['content'],
                'excerpt' => $_POST['excerpt'],
                'creation_date' => date("Y-m-d H:i:s"),
                'post_category' => $_POST['post_category'],
                'post_status' => $_POST['post_status'],
                'post_user' => $_SESSION['user_id']
            ]);
            $last_post_id = $this->post->getLastId();
            
            if (is_array($_FILES['image']) && $_FILES['image']['tmp_name'])
            {
                $image = new ImageController();
                $image_last_insert_id = $image->add($_FILES['image']);
                $update_post = $this->post->update($last_post_id, ['post_image' => $image_last_insert_id]);
                if($update_post && $image_last_insert_id)
                {
                    $_SESSION['flash']['success'] = 'Image ajouté avec succès.';
                }
            }
            if ($create_post) {
                $_SESSION['flash']['success'] = 'Article ajouté avec succès.';
                header('Location: /portofolio/admin/post/');
                throw new \Exception();;
            }
        }   
        $this->render('admin.post.edit', compact('form', 'categories', 'status','author'));
    }

    public function edit()
    {
        $post = $this->post->find($_GET['id']);
        $author = $this->user->extract('id', 'name');
        $categories = $this->category->extract('id', 'name');
        $status = $this->status->extract('id', 'name');
        $form = new Form($post);
        
        if (!empty($_POST)) {
            
            $update_post = $this->post->update($_GET['id'],[
                'name' => $_POST['name'],
                'excerpt' => $_POST['excerpt'],
                'content' => $_POST['content'], 
                'post_category' => $_POST['post_category'],
                'post_status' => $_POST['post_status'],
                'post_user' => $_POST['post_user'] 
            ]);

            if (is_array($_FILES['image']) && $_FILES['image']['tmp_name'])
            {
                $image = new ImageController();
                if($post->image_id === NULL)
                {
                    
                    $image_last_insert_id = $image->add($_FILES['image']);
                    $update_post_image = $this->post->update($post->id, ['post_image' => $image_last_insert_id]);
                    if($image_last_insert_id && $update_post_image)
                    {
                        $_SESSION['flash']['success'] = 'Image ajouté avec succès.';  
                    }
                }
                else
                {
                    $image_last_insert_id = $image->add($_FILES['image']);
                    $update_post = $this->post->update($post->id, ['post_image' => $image_last_insert_id]);
                    if ($update_post && $image_last_insert_id) {
                        $_SESSION['flash']['success'] = 'Image ajouté avec succès.';
                    }
                }
            }
            if ($update_post) {
                $_SESSION['flash']['success'] = 'Article mis à jour avec succès';
                header('Location: /portofolio/admin/post/edit/?id='.$post->id);
                throw new \Exception();;
            }
        }
        $this->render('admin.post.edit', compact('post', 'categories', 'status', 'form', 'author'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $post = $this->post->find($_POST['id']);
            $comments = $this->comment->findAllToDelete($_POST['id']);

            if($comments)
            {
                foreach($comments as $comment){
                    $delete_comment = $this->comment->delete($comment->id);
                    
                }
                if($delete_comment)
                {
                    $_SESSION['flash']['success'] = 'Commentaires supprimé avec succès.';
                }
            }
            
            if($post->image_id !== NULL)
            {
                $image = new ImageController();
                $image_id = $post->image_id;

                $delete_post = $this->post->delete($_POST['id']);
                $delete_image = $image->delete($image_id);

                if($delete_image)
                {
                    $_SESSION['flash']['success'] = "L'article a bien été supprimé";
                }
            }
            else
            {
               $delete_post = $this->post->delete($_POST['id']);
            }
            if ($delete_post) {
                $_SESSION['flash']['success'] = "L'article a bien été supprimé";
                header('Location: /portofolio/admin/post/');
                throw new \Exception();;
            }
        }
    }
}
