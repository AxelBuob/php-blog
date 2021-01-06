<?php
  function debug($var) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
    die();
  }

  function path($path) {
    print_r(realpath($path));
  }
