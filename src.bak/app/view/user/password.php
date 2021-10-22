<h1>Changer le mot de passe</h1>
<form method="post">
    <?= $form->input("password", "Nouveau mot de passe", "", ["type" => "password"]); ?>
    <?= $form->input("password_confirm", "Confirmation du mot de passe", "", ["type" => "password"]); ?>
    <?= $form->submit("Enregistrer"); ?>
</form>