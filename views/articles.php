<?php
  require($_SERVER['DOCUMENT_ROOT'].'/php-blog/config/app.php');
  require($root.'/config/db.php');
  require($root.'/controllers/articlesController.php');
  require($root.'/controllers/commentsController.php');

  $articles = getAllArticles($db);

  include($root.'/includes/header.php');

?>
  <header>
    <h1>Hello world!</h1>
  </header>
<?php
  foreach($articles as $article) {
?>
  <article>
    <h1><?php echo $article->title; ?></h1>
    <p><?php echo $article->date; ?></p>
    <p>

      <?php echo $comment = $article->comments ? 'Comments: '.$article->comments : 'Comments: 0'; ?>
    </p>
    <p><?php echo $article->content; ?></p>
    <a href="<?php echo $host.'views/article.php?id='.$article->id; ?>">Read more</a>
  </article>
<?php
  }
  include($root.'/includes/footer.php');
