<nav>
    <ul>
        <li>Administration :</li>
    </ul>
    <ul>
        <li><a href="?p=admin.post.index">Articles</a></li>
        <li><a href="?p=admin.category.index">Categories</a></li>
    </ul>
</nav>

<form method="post">
    <?= $form->input('name', "Titre"); ?>
    <?= $form->submit('Valider'); ?>
</form>