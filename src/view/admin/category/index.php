<?php
$categories = $app->getTable('category')->all();
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
<p>
    <a href="?p=category.add"><button>Ajouter une catégorie</button></a>
</p>
<table>
    <thead>
        <td>id</td>
        <td>Titre</td>
        <td>Action</td>
    </thead>
    <tbody>
        <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?= $category->id; ?></td>
                <td><?= $category->name; ?></td>
                <td>
                    <a href="?p=category.edit&id=<?= $category->id; ?>"><ins>Éditer</button></a>

                    <form action="?p=category.delete" method="post">
                        <input type="hidden" name="id" value="<?= $category->id; ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>