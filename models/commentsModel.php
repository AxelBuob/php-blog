<?php
  function selectAllComments($db,$article_id) {
    $query = $db->query("SELECT * from comments WHERE article_id=$article_id");
    $query = $query->fetchAll(PDO::FETCH_OBJ);
    return $query;
  }

  function insertComment($db,$post) {
    
  }
