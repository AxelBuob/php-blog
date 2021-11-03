<div class="container my-5">
    <h1>Contact</h1>
    <form method="post">
        <?= $form->input("name", "Nom", "Votre nom"); ?>
        <?= $form->input("email", "Email", "Votre email", ['type' => 'email']); ?>
        <?= $form->input("subject", "Subject", "Le sujet de votre message"); ?>
        <?= $form->input("message", "Message", "Votre message", ['type' => 'textarea']); ?>
        <div class="mt-3">
            <?= $form->submit("Envoyer"); ?>
        </div>
    </form>
</div>