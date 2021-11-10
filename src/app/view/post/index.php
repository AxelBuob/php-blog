<section class="album container py-5">
    <h1 class="mb-3">Les derniers articles</h1>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach ($posts as $post) : ?>
            <?php if ($post->status_name === 'publish') : ?>
                <div class="col">
                    <div class="card border-0 shadow-sm">
                        <img src="https://picsum.photos/500/300?random=<?= $post->id; ?>" alt="Demo" class="img-fluid" width="500" height="300">
                        <div class="card-body">
                            <h3 class="card-title text-uppercase"><?= $post->name; ?></h5>
                                <div class="card-subtitle">
                                    <p><em class="fw-light"><?= $post->creation_date; ?></em></p>
                                </div>
                                <p class="card-text"><?= $post->excerpt; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="<?= $post->url; ?>" type="button" class="btn btn-sm btn-outline-dark">
                                            <i class="fas fa-eye"></i>
                                            <span class="d-none d-md-inline">Lire</span>
                                        </a>
                                    </div>
                                    <a href="<?= $post->category; ?>" type="button" class="btn btn-sm btn-warning">
                                        <span><?= $post->category_name; ?></span>
                                    </a>
                                </div>
                        </div>
                    </div>
                </div>
            <?php endif;  ?>
        <?php endforeach; ?>
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination d-flex justify-content-center mt-3">
            <?php if ($current_page > 1) : ?>
                <li class="page-item"><a class="page-link link-dark" href="?n=<?= $current_page - 1 ?>"><< Précédent</a></li>
            <?php endif; ?>
            <?php if ($current_page < $pages) : ?>
                <li class="page-item"><a class="page-link link-dark" href="?n=<?= $current_page + 1 ?>">Suivant >></a></li>
            <?php endif; ?>
        </ul>
    </nav>
</section>