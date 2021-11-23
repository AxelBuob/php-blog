<div class="container my-5">
    <h1>Paramètres du site</h1>
    <form method="post" enctype="multipart/form-data">
        <?= $form->input('name', 'Titre', '', null); ?>
        <?= $form->input('description', 'Description', '', null); ?>
        <?= $form->input('charset', 'Charset', '', null); ?>
        <?= $form->input('language', 'Langue', '', null); ?>
        <?php if ($site->logo_path) : ?>
            <?= $form->input('image', 'Logo', '', ['type' => 'file']); ?>
            <div class="my-3">
                <img src="<?= $site->logo_path; ?>" alt="Logo <?= $site->name; ?>" width="200px" height="auto">
            </div>
        <?php else : ?>
            <?= $form->input('image', 'logo', '', ['type' => 'file']); ?>
        <?php endif; ?>
        <div class="mt-3">
            <?= $form->submit('Enregister'); ?>
        </div>
    </form>
</div>