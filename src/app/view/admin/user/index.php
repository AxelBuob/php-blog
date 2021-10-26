<p>
    <a href="?p=admin.user.add"><button>Ajouter un utilisateur</button></a>
</p>
<table>
    <thead>
        <td>id</td>
        <td>Email</td>
        <td>Nom</td>
        <td>Action</td>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?= $user->id; ?></td>
                <td><?= $user->email; ?></td>
                <td><?= $user->first_name; ?> <?= $user->last_name; ?></td>
                <td>
                    <a href="?p=admin.user.edit&id=<?= $user->id; ?>"><ins>Éditer</button></a>

                    <form action="?p=admin.user.delete" method="post">
                        <input type="hidden" name="id" value="<?= $user->id; ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>