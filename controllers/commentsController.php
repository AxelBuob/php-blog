<?php
  require($_SERVER['DOCUMENT_ROOT'].'/php-blog/config/app.php');
  require($root.'models/commentsModel.php');
  require($root.'controllers/formController.php');

  function getAllComments($db,$article_id) {
    $query = selectAllComments($db,$article_id);
    return $query;
  }

  function insert($db,$article_id,$post) {
    $error = checkInput($_POST);
    if(empty($error)) {
      trimInput($post);
      $post['article_id'] = $article_id;
      $query = insertComment($db,$post);
    }
    return $error;
  }
