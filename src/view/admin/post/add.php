<?php

use Core\Html\Form;

if (!empty($_POST)) {
    $result = $app->getTable('post')->create(['name' => $_POST['name'], 'content' => $_POST['content'], 'post_category' => $_POST['post_category']]);
    if ($result) {
        header('Location: admin.php?p=post.index');
    }
}
$categories = $app->getTable('category')->extract('id', 'name');
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
    <?= $form->input('content', 'Contenu', '', ['type' => 'textarea']); ?>
    <?= $form->select('post_category', 'Catégorie', $categories); ?>
    <?= $form->submit('Valider'); ?>
</form>