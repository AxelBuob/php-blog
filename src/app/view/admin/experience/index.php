<div class="container my-5">
    <div class="d-flex justify-content-end my-3">
        <a href="?p=admin.experience.add" class="btn btn-warning text-uppercase fw-light">Ajouter une expérience</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Nom</th>
                <th>Company</th>
                <th>Début</th>
                <th>Fin</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($experiences as $experience) : ?>
                    <tr>
                        <td><?= $experience->id; ?></td>
                        <td><?= $experience->name; ?></td>
                        <td><?= $experience->company; ?></td>
                        <td><?= $experience->start_date; ?></td>
                        <td><?= $experience->end_date; ?></td>
                        <td>
                            <a href="?p=admin.experience.edit&id=<?= $experience->id; ?>" class="btn btn-outline-warning">Éditer</a>
                            <form class="d-inline" action="?p=admin.experience.delete" method="post">
                                <input type="hidden" name="id" value="<?= $experience->id; ?>">
                                <button class="btn btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>