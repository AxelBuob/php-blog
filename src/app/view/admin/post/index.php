<p>
    <a href="?p=admin.post.add"><button>Ajouter un article</button></a>
</p>
<table>
    <thead>
        <td>id</td>
        <td>Titre</td>
        <td>Action</td>
    </thead>
    <tbody>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <td><?= $post->id; ?></td>
                <td><?= $post->name; ?></td>
                <td>
                    <a href="?p=admin.post.edit&id=<?= $post->id; ?>"><ins>Éditer</button></a>

                    <form action="?p=admin.post.delete" method="post">
                        <input type="hidden" name="id" value="<?= $post->id; ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>