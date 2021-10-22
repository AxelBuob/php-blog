<h1>Changer de email</h1>
<form method="post">
    <?= $form->input("email", "Nouveau email", "", ["type" => "email"]); ?>
    <?= $form->input("email_confirm", "Confirmation de l'email", "", ["type" => "email"]); ?>
    <?= $form->submit("Enregistrer"); ?>
</form>