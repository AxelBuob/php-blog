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