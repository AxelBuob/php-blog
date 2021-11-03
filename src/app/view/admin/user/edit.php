<div class="container my-5">
    <form method="post">
        <?= $form->input('email', "Email", "", []); ?>
        <?= $form->input('password', "Mot de passe", "", ['type' => 'password']); ?>
        <?= $form->input('first_name', "Prénom", "", []); ?>
        <?= $form->input('last_name', "Nom", "", []); ?>
        <?= $form->select('user_role', 'Rôle', $roles); ?>
        <?= $form->submit('Enregistrer'); ?>
    </form>
</div>