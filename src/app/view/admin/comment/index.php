<table>
    <thead>
        <td>id</td>
        <td>Date</td>
        <td>status</td>
        <td>Action</td>
    </thead>
    <tbody>
        <?php foreach ($comments as $comment) : ?>
            <tr>
                <td><?= $comment->id; ?></td>
                <td><?= $comment->creation_date; ?></td>
                <td><?= $comment->status_name; ?></td>
                <td>
                    <a href="?p=admin.comment.show&id=<?= $comment->id; ?>"><ins>Voir</button></a>
                    <form action="?p=admin.comment.delete" method="post">
                        <input type="hidden" name="id" value="<?= $comment->id; ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>