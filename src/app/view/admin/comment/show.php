<section>
    <h2>Le <?= $comment->creation_date; ?> par <?= $comment->first_name; ?> <?= $comment->last_name; ?></h2>
    <p><?= $comment->content; ?></p>
    <form method="post">
        <?= $form->select('comment_status', 'Status', $status); ?>
        <?= $form->submit('Valider'); ?>
    </form>
</section>
