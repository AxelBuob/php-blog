<?php
  require($_SERVER['DOCUMENT_ROOT'].'/php-blog/config/app.php');
  require($root.'/config/db.php');
  require($root.'/controllers/articlesController.php');
  require($root.'/controllers/commentsController.php');

  $article = getArticleId($db);
  $comments = getAllComments($db,$article->id);

  include($root.'/includes/header.php');
?>
  <header>
    <h1><?php echo $article->title; ?></h1>
  </header>
  <p><?php echo $article->date; ?></p>
  <p><?php echo $article->content; ?></p>
  <h2>Comments</h2>
  <ul>
<?php
  foreach ($comments as $comment) {
?>
  <li>
    <b><?php echo $comment->author; ?></b>
    <em><?php echo $comment->date; ?></em>
    <p><?php echo $comment->comment; ?></p>
  </li>
<?php
  }
?>
  </ul>
  <form action="<?php echo $host.'controllers/commentsController.php'; ?>" method="POST">
    <label for="author">Enter your name:</label><br>
    <input type="text" name="name"><br>
    <label for="comment">Enter your message:</label><br>
    <textarea name="comment" rows="8" cols="80"></textarea><br>
    <input type="submit">
  </form>
<?php
  include($root.'/includes/footer.php');
