<div class="container mt-5">
    <h1>Connection</h1>
    <form method="post">
        <?= $form->input("email", "Email", "Votre email"); ?>
        <?= $form->input("password", "Mot de passe", "Votre mot de passe", ["type" => "password"]); ?>
        <div class="mt-3">
            <?= $form->submit("Valider"); ?>
            <a class="btn btn-outline-dark text-uppercase fw-light" href="?p=user.forget">Réinitialiser le mot de passe</a>
        </div>
    </form>
</div>
