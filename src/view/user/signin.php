<?php
use Core\Html\Form;
use Core\Auth\Auth;
$form = new Core\Html\Form;

if(!empty($_POST))
{
    $auth = new Auth($app->getDB());
    if( $auth->login($_POST['email'], $_POST['password']))
    {
       header('Location: admin.php');
    }
    else
    {
        ?>
            <input type="text" aria-invalid="true" value="Indentifiants incorrects" readonly>
        <?php
    }
   
}

?>
<h1>Connection</h1>
<form method="post">
    <?= $form->input("email", "Nom d'utilisateur", "Nom d'utilisateur"); ?>
    <?= $form->input("password", "Mot de passe", "Votre mot de passe", ["type" => "password"]); ?>
    <?= $form->submit("Envoyer"); ?>
</form>