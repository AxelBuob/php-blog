<h1>Contact</h1>
<form method="post">
    <?= $form->input("name", "Nom", "Votre nom"); ?>
    <?= $form->input("email", "Email", "Votre email", ['type' => 'email']); ?>
    <?= $form->input("subject", "Subject", "Le sujet de votre message"); ?>
    <?= $form->input("message", "Message", "Votre message", ['type' => 'textarea']); ?>
    <?= $form->submit("Envoyer"); ?>
</form>