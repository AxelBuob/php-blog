<div class="container mt-5">
    <p>
        <a class="text-dark" href="<?= $post->user; ?>"><?= $post->user_name; ?></a>, <?= $post->creation_date; ?> dans la catégorie <a class="link-dark" href="<?= $post->category; ?>"><?= $post->category_name; ?></a>
    </p>
</div>
<div class="container">
    <h1 class=""><?= $post->name; ?></h1>
    <?php if ($post->image_path) : ?>
        <figure class="figure mt-3">
            <img src="<?= $post->image_path; ?>" alt="Demo" class="img-fluid" width="500" height="300">
            <figcaption class="figure-caption text-end">A caption for the above image.</figcaption>
        </figure>
    <?php endif; ?>
    <p><?= $post->content; ?>
</div>
</div>
<div class="bg-light py-5">
    <?php if ($comments) : ?>
        <div class="container">
            <h5 class="text-uppercase">Les derniers commentaires</h5>
            <?php foreach ($comments as $comment) : ?>
                <figure class="mb-0 mt-3">
                    <blockquote class="blockquote">
                        <?= $comment->content; ?>
                    </blockquote>
                    <figcaption class="blockquote-footer mb-0">
                        <?= $comment->creation_date; ?> par <cite title="Source Title"><a class="link-dark" href="#"><?= $comment->user_name; ?></a></cite>
                    </figcaption>
                </figure>
                <?php if ($auth && $comment->user_id === $_SESSION['user_id']) : ?>
                    <form class="mt-3" action="/portofolio/comment/delete/" method="post">
                        <?= $form->input('comment_id', '', '', ['type' => 'hidden', 'value' => $comment->id]); ?>
                        <?= $form->input('post_id', '', '', ['type' => 'hidden', 'value' => $comment->post_id]); ?>
                        <button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button>
                    </form>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="container mt-5">
        <h5 class="text-uppercase">Laisser un commentaire</h5>
        <?php if ($auth) : ?>
            <form action="/portofolio/comment/add" method="post">
                <?= $form->input('comment_post', '', '', ['type' => 'hidden', 'value' => $post->id]); ?>
                <?= $form->input('content', '', '', ['type' => 'textarea']); ?>
                <button type="submit" class="mt-3 btn btn-sm btn-warning text-uppercase text-light text-dark">Laisser un commentaire</button>
            </form>
        <?php else : ?>
            <div role="alert" class="alert alert-info">
                <p>Vous devez être connecté pour pouvoir laisser un commentaire.</p>
                <a class="link-dark" href="/portofolio/user/signin">Se connecter</a> / <a class="link-dark" href="/portofolio/user/signup">S'inscrire</a>
            </div>
        <?php endif; ?>
    </div>
</div>