<?php
  function checkInput($post) {
    $error = [];
    foreach($post as $key => $value) {
      if(empty($post[$key])) {
        $error[$key] = 'Please enter your '.$key;
      }
    }
    return $error;
  }

  function trimInput($post) {
    foreach($post as $key => $value) {
      $clean[$key] = trim($post[$key]);
      $clean[$key] = stripslashes($post[$key]);
      $clean[$key] = htmlspecialchars($post[$key]);
    }
    return $clean;
  }
