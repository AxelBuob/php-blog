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
<section>
    <h1>Les derniers articles dans la catégorie <?= $category_name->name; ?></h1>
    <?php foreach ($posts as $post) : ?>
        <article>
            <h2>
                <a href="<?= $post->url; ?>"><?= $post->name; ?></a>
            </h2>
            <p><?= $post->excerpt; ?></p>
            <a href="<?= $post->url; ?>">Lire la suite</a>
            <footer>
                <small>
                    Publié le <?= $post->creation_date; ?> par <a href="#">Axel Buob</a> dans la catégorie <a href="<?= $post->category; ?>"><?= $post->category_name; ?></a>
                </small>
            </footer>
        </article>
    <?php endforeach; ?>
</section>