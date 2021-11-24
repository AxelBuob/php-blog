<div class="container my-5">
    <form method="post">
        <?= $form->input('name', 'Nom', ''); ?>
        <?= $form->input('company', 'Entreprise', ''); ?>
        <?= $form->input('city', 'Ville', ''); ?>
        <?= $form->input('postcode', 'Code postale', ''); ?>
        <?= $form->input('start_date', 'Début', '', ['type' => 'date']); ?>
        <?= $form->input('end_date', 'Fin', '', ['type' => 'date']); ?>
        <?= $form->submit('Enregistrer'); ?>
    </form>
</div>
