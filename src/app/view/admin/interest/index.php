<div class="container my-5">
    <div class="d-flex justify-content-end">
        <a href="/portofolio/admin/interest/add/" class="btn btn-warning text-uppercase fw-light">Ajouter un intérêt</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($interests as $interest) : ?>
                    <tr>
                        <td><?= $interest->id; ?></td>
                        <td><?= $interest->name; ?></td>
                        <td>
                            <a href="/portofolio/admin/interest/edit/?id=<?= $interest->id; ?>" class="btn btn-outline-warning">Éditer</a>
                            <form class="d-inline" action="/portofolio/admin/interest/delete" method="post">
                                <input type="hidden" name="id" value="<?= $interest->id; ?>">
                                <button class="btn btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>