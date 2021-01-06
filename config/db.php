<?php
  require('app.php');

  try {
    $db = new PDO('mysql:host='.$server_name.';dbname='.$db_name.';charset=utf8',$db_username,$db_user_password);
  }
  catch(Exception $e) {
      die('Erreur :'. $e->getMessage());
  }
