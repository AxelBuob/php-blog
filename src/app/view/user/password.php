<div class="container mt-5">
    <h1>Changer de mot de passe</h1>
    <form method="post">
        <?= $form->input("password", "Nouveau mot de passe", "", ["type" => "password"]); ?>
        <?= $form->input("password_confirm", "Confirmation du mot de passe", "", ["type" => "password"]); ?>
        <div class="mt-3">
            <?= $form->submit("Enregistrer"); ?>
        </div>
    </form>
</div>
