<?php
  require($_SERVER['DOCUMENT_ROOT'].'/php-blog/config/app.php');
  require($root.'models/commentsModel.php');

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(!isset($_POST['author']) OR $_POST['author'] == '') {
      echo 'error';
    } else {
      echo 'Adding your comments..';
    }
  }

  function getAllComments($db,$article_id) {
    $query = selectAllComments($db,$article_id);
    return $query;
  }
