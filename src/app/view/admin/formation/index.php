<div class="container my-5">
    <div class="d-flex justify-content-end my-3">
        <a href="?p=admin.formation.add" class="btn btn-warning text-uppercase fw-light">Ajouter une formation</a>
    </div>
    <div class="table-reponsive">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Nom</th>
                <th>École</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($formations as $formation) : ?>
                    <tr>
                        <td><?= $formation->id; ?></td>
                        <td><?= $formation->name; ?></td>
                        <td><?= $formation->school; ?></td>
                        <td><?= $formation->start_date; ?></td>
                        <td><?= $formation->end_date; ?></td>
                        <td>
                            <a href="?p=admin.formation.edit&id=<?= $formation->id; ?>" class="btn btn-outline-warning">Éditer</a>
                            <form class="d-inline" action="?p=admin.formation.delete" method="post">
                                <input type="hidden" name="id" value="<?= $formation->id; ?>">
                                <button class="btn btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>