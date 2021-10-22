<?php

if (!empty($_POST)) {
    $result = $app->getTable('post')->delete($_POST['id']);
    if ($result) {
        header('Location: admin.php?p=post.index');
    }
}
