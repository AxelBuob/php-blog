<section>
    <nav>
        <ul>
            <li><strong>Catégories:</strong></li>
        </ul> 
        <ul>
            <?php foreach ($categories as $category) : ?>
                <li>
                    <a href="<?= $category->url; ?>"><?= $category->name; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>
</section>

<section>
    <h1>Les derniers articles</h1>
    <?php foreach ($posts as $post) : ?>
        <article>
            <h2><a href="<?= $post->url; ?>"><?= $post->name; ?></a></h2>
            <p><?= $post->excerpt; ?></p>
            <a href="<?= $post->url; ?>">Lire la suite</a>
            <footer>
                <p>Posté le <?= $post->creation_date; ?> par <a href="#">Axel Buob</a> dans la catégorie <a href="<?= $post->category; ?>"><?= $post->category_name; ?></a></p>
            </footer>
        </article>
    <?php endforeach; ?>
</section>