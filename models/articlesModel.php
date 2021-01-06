<?php
  function selectAllArticles($db) {
    $query = $db->query("SELECT a.*, COUNT(c.id) as comments
                         FROM articles a
                         LEFT JOIN comments c ON a.id = c.article_id
                         GROUP BY 1");
    $query = $query->fetchAll(PDO::FETCH_OBJ);
    return $query;
  }

  function selectArticleId($db,$id) {
    $query = $db->query("SELECT * from articles WHERE id=$id");
    $query = $query->fetch(PDO::FETCH_OBJ);
    return $query;
  }
