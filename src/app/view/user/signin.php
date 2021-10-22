<h1>Connection</h1>
<form method="post">
    <?= $form->input("email", "Email", "Votre email"); ?>
    <?= $form->input("password", "Mot de passe", "Votre mot de passe", ["type" => "password"]); ?>
    <?= $form->submit("Envoyer"); ?>
    <a href="?p=user.forget">Réinitialiser le mot de passe</a>
</form>