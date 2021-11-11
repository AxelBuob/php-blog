<div class="container my-5">
    <div class="d-flex justify-content-end">
        <a href="/portofolio/admin/skill/add/" class="btn btn-warning text-uppercase fw-light">Ajouter une compétence</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Titre</th>
                <th>Icon</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($skills as $skill) : ?>
                    <tr>
                        <td><?= $skill->id; ?></td>
                        <td><?= $skill->name; ?></td>
                        <td><i class="<?= $skill->class; ?> fa-2x"></i></td>
                        <td>
                            <a href="/portofolio/admin/skill/edit/?id=<?= $skill->id; ?>" class="btn btn-outline-warning">Éditer</a>
                            <form class="d-inline" action="/portofolio/admin/skill/delete" method="post">
                                <input type="hidden" name="id" value="<?= $skill->id; ?>">
                                <button class="btn btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>