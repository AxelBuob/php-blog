<?php include('../includes/header.php'); ?>

<h1>Crypt password</h1>
<?php if(isset($_POST['user']) AND isset($_POST)) { ?>
  <p>Ligne à copier dans le fichier .htpasswd:</p>
  <p><?php echo $_POST['user'].':'.password_hash($_POST['password'], PASSWORD_BCRYPT); ?></p>
<?php } else { ?>
  <form action="#" method="post">
    <label for="user">
      Username
      <input type="text" name="user">
    </label>
    <label for="password">
      Password
      <input type="password" name="password">
    </label>
    <input type="submit">
  </form>
<?php } ?>

<?php include('../includes/footer.php'); ?>
