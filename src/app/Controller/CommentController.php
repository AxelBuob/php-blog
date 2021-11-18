<?php

namespace App\Controller;

class CommentController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('post');
        $this->loadModel('comment');
    }

    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->comment->create([
                'content' => $_POST['content'],
                'creation_date' => date("Y-m-d H:i:s"),
                'comment_user' => $_SESSION['user_id'],
                'comment_post' => $_POST['comment_post'],
                'comment_status' => 2
            ]);
            if ($result) {
                $_SESSION['flash']['success'] = 'Merci votre commentaire a été soumis à validation';
                header('Location: /portofolio/post/show/?id=' . $_POST['comment_post']);
                throw new \Exception();
            } else {
                $_SESSION['flash']['danger'] = 'Oups! Une erreur est survenus';
                header('Location: /portofolio/post/show/?id=' . $_POST['comment_post']);
                throw new \Exception();
            }
        }
    }

    public function delete()
    {
        if(!empty($_POST))
        {
            $result = $this->comment->delete($_POST['comment_id']);
            if ($result) {
                $_SESSION['flash'] = 'Votre commentaire a bien été supprimé.';
                header('Location: /portofolio/post/show/?id='. $_POST['post_id']);
                throw new \Exception();
            } 
            else
            {
                $_SESSION['flash'] = 'Oups! Une erreur est survenus.';
                header('Location: /post/show/?id=' . $_POST['post_id']);
                throw new \Exception();
            }
        }
            
    }

}
