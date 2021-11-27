<div class="container my-5">
    <h1>Paramètres du compte</h1>
    <a class="btn btn-outline-dark" href="/portofolio/user/password">Changer de mot de passe</a>
    <form action="#" method="post">
        <?= $form->input('first_name', 'Prénom', 'Votre prénom'); ?>
        <?= $form->input('last_name', 'Nom', 'Votre nom'); ?>
        <?= $form->input('job', 'Job', 'Votre job'); ?>
        <?= $form->input('about', 'À propos', '', ['type' => 'textarea']); ?>
        <?= $form->input('city', 'Ville', ''); ?>
        <?= $form->input('twitter', 'Twitter', 'Lien vers votre compte Twitter'); ?>
        <?= $form->input('github', 'Github', 'Lien vers votre compte Github'); ?>
        <?= $form->input('linkedin', 'Linkedin', 'Lien vers votre compte Linkedin'); ?>
        <div class="mt-3">
            <?= $form->submit('Enregister'); ?>
        </div>
    </form>
</div>
