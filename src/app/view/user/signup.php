<div class="container mt-5">
    <h1>Inscription</h1>
    <form method="post">
        <?= $form->input("email", "Email", "Votre email", ["type" => "email"]); ?>
        <?= $form->input("password", "Mot de passe", "Votre mot de passe", ["type" => "password"]); ?>
        <?= $form->input("password_confirm", "Confimation de mot de passe", "Confimation du mot de passe", ["type" => "password"]); ?>
        <div class="mt-3">
            <?= $form->submit("Envoyer"); ?>
        </div>
    </form>
</div>