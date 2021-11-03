<div class="container mt-5">
    <h2>Le <?= $comment->creation_date; ?></h2>
    <p><?= $comment->content; ?></p>
    <p><em>par <?= $comment->user_name; ?></em></p>
    <form method="post">
        <?= $form->select('comment_status', 'Status', $status); ?>
        <?= $form->submit('Enregistrer'); ?>
    </form>
</div>