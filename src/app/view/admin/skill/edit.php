<div class="container my-5">
    <form method="post">
        <?= $form->input('name','Nom',''); ?>
        <?= $form->input('class', 'Class icon CSS', ''); ?>
        <?= $form->submit('Enregistrer'); ?>
    </form>
</div>