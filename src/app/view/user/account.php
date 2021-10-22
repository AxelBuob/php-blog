<h1>Votre compte</h1>
<nav>
    <ul>
        <li>Administrer son compte:</li>
    </ul>
    <ul>
        <li><a href="?p=user.password">Changer de mot de passe</a></li>
        <li><a href="?p=user.email">Changer de email</a></li>
    </ul>
</nav>
<form action="#" method="post">
    <?= $form->input('first_name', 'Prénom', 'Votre prénom'); ?>
    <?= $form->input('last_name', 'Nom', 'Votre nom'); ?>
    <?= $form->input('about', 'À propos', '', ['type' => 'textarea']); ?>
    <?= $form->input('city', 'Ville',''); ?>
    <?= $form->input('twitter', 'Twitter', 'Lien vers votre compte Twitter'); ?>
    <?= $form->input('github', 'Github', 'Lien vers votre compte Github'); ?>
    <?= $form->input('linkedin', 'Linkedin', 'Lien vers votre compte Linkedin'); ?>
    <!-- <?= $form->input('password', 'Mot de passe', 'Nouveau mot de passe', ['type' => 'password']); ?>
    <?= $form->input('password_confirm', 'Confirmation de mot de passe', 'Confirmation de mot de passe', ['type' => 'password']); ?> -->
    <?= $form->submit('Enregister'); ?>
</form>