<div class="container-fluid my-5">
    <div class="d-flex justify-content-end my-3">
        <a class="btn btn-warning link-dark text-uppercase fw-light" href="/portofolio/admin/post/add/">Ajouter un article</a>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <td>#</td>
                <td>Titre</td>
                <td>Catégorie</td>
                <td>Date</td>
                <td>Status</td>
                <td>Auteur</td>
                <td>Action</td>
            </thead>
            <tbody>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?= $post->id; ?></td>
                        <td><?= $post->name; ?></td>
                        <td><?= $post->category_name; ?></td>
                        <td><?= $post->creation_date; ?></td>
                        <td><?= $post->status_name; ?></td>
                        <td><?= $post->user_name; ?></td>
                        <td>
                            <a class="btn btn-outline-warning" href="/portofolio/admin/post/edit/?id=<?= $post->id; ?>">Éditer</a>
                            <form class="d-inline" action="/portofolio/admin/post/delete" method="post">
                                <input type="hidden" name="id" value="<?= $post->id; ?>">
                                <button onclick="return confirm('Confirmer la suppression ?');" type="submit" class="btn btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>