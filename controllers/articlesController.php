<?php
  require($root.'models/articlesModel.php');

  function getAllArticles($db) {
    $query = selectAllArticles($db);
    return $query;
  }

  function getArticleId($db) {
    if(!isset($_GET['id']) OR $_GET['id'] == '' OR !$_GET['id']) {
      header('HTTP/1.1 404 Not Found');
      include('../views/404.php');
      exit;
    } else {
      $id = htmlspecialchars($_GET['id']);
      $query = selectArticleId($db,$id);
      if(!$query) {
        header('HTTP/1.1 404 Not Found');
        include('../views/404.php');
        exit;
      } else {
        return $query;
      }
    }
  }
