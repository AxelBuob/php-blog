<div class="container my-5">

    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <?php if ($post_image) : ?>
                    <img src="<?= $post_image->path; ?>" alt="Image à la une" width="150px" height="auto">
                    <div class="container">
                        <a href="?p=admin.image.delete&id=<?=$post_image->id; ?>" class="btn btn-outline-danger btn-sm mt-3">Supprimer</a>
                    </div>
                <?php else : ?>
                    <?= $form->input('image', 'Image à la une', '', ['type' => 'file']); ?>
                <?php endif; ?>
                <?= $form->select('post_status', 'Status', $status); ?>
                <?= $form->select('post_category', 'Catégorie', $categories); ?>
            </div>
            <div class="col-md-8">
                <?= $form->input('name', "Titre"); ?>
                <?= $form->input('content', 'Contenu', '', ['type' => 'textarea']); ?>
                <?= $form->submit('Enregistrer'); ?>
            </div>
        </div>
    </form>


</div>
<script src="https://cdn.tiny.cloud/1/us6lu5txassmmez5y0vq3ber24e0ksic4auvdrcrpbreywwf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
    });
</script>