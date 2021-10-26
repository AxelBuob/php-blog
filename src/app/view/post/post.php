<section>
    <nav>
        <ul>
            <li><strong>Catégories:</strong></li>
        </ul>
        <ul>
            <?php foreach ($categories as $category) : ?>
                <li><a href="<?= $category->url; ?>"><?= $category->name; ?> | </a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
</section>

<h1><?= $post->name; ?></h1>
<p>
    <small>
        Publié le <?= $post->creation_date; ?> par <a href="#">Axel Buob</a> dans la catégorie <a href="<?= $category->url; ?>"><?= $category->name; ?></a>
    </small>
</p>
<p>
    <?= $post->content; ?>
</p>

<section>
    <?php if ($comments) : ?>
        <?php foreach ($comments as $comment) : ?>
            <article>
                <p>Par <?= $comment->first_name; ?> <?= $comment->last_name; ?> le <?= $comment->creation_date; ?></p>
                <p><?= $comment->content; ?></p>
                <?php if ($auth && $comment->comment_user === $_SESSION['user_id']) : ?>
                    <form action="?p=comment.delete" method="post">
                        <?= $form->input('comment_id', '','',['type' => 'hidden', 'value' => $comment->id]); ?>
                        <?= $form->input('post_id', '','',['type' => 'hidden', 'value' => $comment->comment_post]); ?>
                        <?= $form->submit('Supprimer'); ?>
                    </form>
                <?php endif; ?>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
    <h2>Laisser un commentaire</h2>
    <?php if ($auth) : ?>
        <form action="?p=comment.add" method="post">
            <?= $form->input('comment_post', '', '', ['type' => 'hidden', 'value' => $post->id]); ?>
            <?= $form->input('content', 'Commentaire', '', ['type' => 'textarea']); ?>
            <?= $form->submit('Laisser un commentaire'); ?>
        </form>
    <?php else : ?>
        <p>Vous devez être connecté ou créer un compte pour laisser un commentaire</p>
        <a href="?p=user.signin">Se connecter</a> <a href="?p=user.signup">S'inscrire</a>
    <?php endif; ?>
</section>