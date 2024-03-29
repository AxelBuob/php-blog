<?php

namespace App\Controller\Admin;

use App\Controller\AppController;
use Core\Html\Form;

class CommentController extends AppController
{

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('comment');
        $this->loadModel('status');
    }

    public function index()
    {
        $comments = $this->comment->all();
        $this->render('admin.comment.index', compact('comments'));
    }

    public function show()
    {
        $comment = $this->comment->find($_GET['id']);
        if(!empty($_POST))
        {
            $result = $this->comment->update($comment->comment_id,[
                'comment_status' => $_POST['comment_status']
            ]);

            if($result)
            {
                $_SESSION['flash']['success'] = 'Le status du commentaire a bien été modifié.';
                header('Location: /portofolio/admin/comment/');
                throw new \Exception();;
            }
        }
        $status = $this->status->extract('id', 'name'); 
        $form = new Form($comment);
        $this->render('admin.comment.show', compact('comment', 'status', 'form'));
    }


    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->comment->delete($_POST['id']);
            if ($result) {
                $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé';
                header('Location: /portofolio/admin/comment/');
                throw new \Exception();;
            }
            $_SESSION['flash']['danger'] = 'Oups! Une erreur est survenus';
            header('Location: /portofolio/admin/comment/');
            throw new \Exception();;
        }
    }
}
