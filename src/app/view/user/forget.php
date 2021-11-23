<div class="container mt-5">
    <h1>Réinitialiser le mot de passe</h1>
    <form method="post">
        <?= $form->input('email', 'Email', '', ['type' => 'email']); ?>
        <div class="mt-3">
            <?= $form->submit('Envoyer'); ?>
        </div>
    </form>
</div>
