<?php
  require($_SERVER['DOCUMENT_ROOT'].'/php-blog/config/app.php');
  require($root.'config/db.php');
  include($root.'includes/header.php');

  if(isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
  } else {
    echo 'Aucun article ne correspond à votre recherche.';
  }

  $article = $db->query("SELECT * FROM articles WHERE id=$id");
  $comments = $db->query("SELECT * FROM comments WHERE article_id=$id");

  if($req = $article->fetch())
  {
    ?>
      <article>
        <h2><?php echo $req['title']; ?></h2>
        <em><?php $req['article_date']; ?></em>
        <p><?php echo $req['content']; ?></p>
        <h3>Commentaires</h3>
          <ul>
            <?php
              while($req = $comments->fetch()) {
                ?>
                  <li>
                    <b><?php echo $req['author']; ?></b>
                    <em><?php echo $req['comment_date']; ?></em>
                    <p><?php echo $req['comment']; ?></p>
                  </li>
                <?php
              }
            ?>
          </ul>
        <h4>Ajouter un commentaire</h4>
        <form action="add_comment.php?id=<?php echo $id; ?>" method="post">
          <label for="author">Auteur
            <input type="text" name="author">
          </label>
          <label for="comment">
            <textarea name="comment"cols="30" rows="10"></textarea>
          </label>
          <input type="submit">
        </form>
      </article>
    <?php
  }
  else
  {
    echo 'Aucun article ne correspond à votre recherche.';
  }

  include($root.'includes/footer.php');
