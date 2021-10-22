<?php

if (!empty($_POST)) {
    $result = $app->getTable('category')->delete($_POST['id']);
    if ($result) {
        header('Location: admin.php?p=category.index');
    }
}
