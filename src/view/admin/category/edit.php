<?php

use Core\Html\Form;

if (!empty($_POST)) {
    $result = $app->getTable('category')->update($_GET['id'], ['name' => $_POST['name']]);
    if ($result) {
        header('Location: admin.php?p=category.index');
    }
}

$category = $app->getTable('category')->find($_GET['id']);
$form = new Form($category);
?>

<nav>
    <ul>
        <li>Administration :</li>
    </ul>
    <ul>
        <li><a href="?p=post.index">Articles</a></li>
        <li><a href="?p=category.index">Categories</a></li>
    </ul>
</nav>

<form method="post">
    <?= $form->input('name', "Titre"); ?>
    <?= $form->submit('Valider'); ?>
</form>