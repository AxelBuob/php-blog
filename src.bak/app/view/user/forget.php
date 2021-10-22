<h1>Réinitialiser le mot de passe</h1>
<form method="post">
    <?= $form->input('email', 'Email', '', ['type' => 'email']); ?>
    <?= $form->submit('Envoyer'); ?>
</form>