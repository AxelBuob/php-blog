<?php
  require($_SERVER['DOCUMENT_ROOT'].'/php-blog/config/app.php');
  require($root.'config/db.php');

  if (!isset($_GET['id']) OR $_GET['id'] == '')
  {
    echo "Aucun article trouvé.";
  }
  elseif(!isset($_POST['author']) OR $_POST['author'] == '')
  {
    echo 'Veuillez renseigner votre nom';
  }
  elseif(!isset($_POST['comment']) OR $_POST['comment'] == '')
  {
    echo 'Veuillez renseigner votre commentaire';
  }
  else
  {
    $article_id = $_GET['id'];
    $author = htmlspecialchars($_POST['author']);
    $comment = htmlspecialchars($_POST['comment']);


    $req = $db->prepare('INSERT INTO comments(article_id, author, comment) VALUES (:article_id, :author, :comment)');
    $req  = $req->execute(array(
      'article_id' => $article_id,
      'author' => $author,
      'comment' => $comment
    ));

    if($req) {
        header("Location: article.php?id='$article_id'");
    } else {
      echo 'Impossible d\'ajouter votre commentaire';
    }

  }
