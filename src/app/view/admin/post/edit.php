<form method="post">
    <?= $form->input('name', "Titre"); ?>
    <?= $form->input('content', 'Contenu', '', ['type' => 'textarea']); ?>
    <?= $form->select('post_category', 'Catégorie', $categories); ?>
    <?= $form->submit('Valider'); ?>
</form>