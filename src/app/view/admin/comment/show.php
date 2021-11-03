<div class="container mt-5">
    <?php var_dump($comment); ?>
    <h2>Le <?= $comment->creation_date; ?></h2>
    <p><?= $comment->content; ?></p>
    <form method="post">
        <?= $form->select('comment_status', 'Status', $status); ?>
        <?= $form->submit('Enregistrer'); ?>
    </form>
</div>