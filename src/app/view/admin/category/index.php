<div class="container my-5">
    <div class="d-flex justify-content-end my-3">
        <a class="btn btn-warning link-dark text-uppercase fw-light" href="/portofolio/admin/category/add">Ajouter une categorie</a>
    </div>
    <div class="table-reponsive">
        <table class="table">
            <thead>
                <td>#</td>
                <td>Titre</td>
                <td>Action</td>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) : ?>
                    <tr>
                        <td><?= $category->id; ?></td>
                        <td><?= $category->name; ?></td>
                        <td>
                            <a class="btn btn-outline-warning" href="/portofolio/admin/category/edit/?id=<?= $category->id; ?>">Éditer</a>
                            <form class="d-inline" action="/portofolio/admin/category/delete" method="post">
                                <input type="hidden" name="id" value="<?= $category->id; ?>">
                                <button class="btn btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
