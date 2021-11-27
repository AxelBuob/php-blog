<div class="container my-5">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <td>#</td>
                <td>Article</td>
                <td>Date</td>
                <td>Auteur</td>
                <td>Status</td>
                <td>Action</td>
            </thead>
            <tbody>
                <?php foreach ($comments as $comment) : ?>
                    <tr>
                        <td><?= $comment->id; ?></td>
                        <td><?= $comment->post_name; ?></td>
                        <td><?= $comment->creation_date; ?></td>
                        <td><?= $comment->user_email; ?></td>
                        <td><?= $comment->status_name; ?></td>
                        <td>
                            <a class="btn btn-outline-warning" href="/portofolio/admin/comment/show/?id=<?= $comment->id; ?>">Lire</a>
                            <form class="d-inline" action="/portofolio/admin/comment/delete" method="post">
                                <input type="hidden" name="id" value="<?= $comment->id; ?>">
                                <button onclick="return confirm('Confirmer la suppression ?');"  class="btn btn-outline-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>