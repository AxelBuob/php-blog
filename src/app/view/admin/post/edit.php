<div class="container my-5">
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <?php if ($post->image_path) : ?>
                    <?= $form->input('image', 'Image à la une', '', ['type' => 'file']); ?>
                    <div class="my-3">
                        <img src="<?= $post->image_path; ?>" alt="<?= $post->name; ?>" width="200px" height="auto">
                    </div>
                <?php else : ?>
                    <?= $form->input('image', 'Image à la une', '', ['type' => 'file']); ?>
                <?php endif; ?>
                <?= $form->select('post_status', 'Status', $status); ?>
                <?= $form->select('post_category', 'Catégorie', $categories); ?>
                <?= $form->select('post_user', 'Auteur', $author); ?>
            </div>
            <div class="col-md-8">
                <?= $form->input('name', "Titre"); ?>
                <?= $form->input('excerpt', "En-tête"); ?>
                <?= $form->input('content', 'Contenu', '', ['type' => 'textarea']); ?>
                <?= $form->submit('Enregistrer'); ?>
            </div>
        </div>
    </form>
</div>
