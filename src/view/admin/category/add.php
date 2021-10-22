<?php

use Core\Html\Form;

if (!empty($_POST)) {
    $result = $app->getTable('category')->create(['name' => $_POST['name']]);
    if ($result) {
        header('Location: admin.php?p=category.index');
    }
}
$form = new Form($_POST);
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