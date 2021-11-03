<div class="container mt-5">
    <h1><?= $user->first_name; ?> <?= $user->last_name; ?></h1>
    <h2 class="lead text-muted"><?= $user->about; ?></h2>
    <div class="my-3">
        <p>Inscris depuis le: <?= date('j F Y', strtotime($user->confirmed_at)); ?></p>
        <p>Ville: <?= $user->city; ?></p>
        <p>Twitter: <a href="<?= $user->twitter; ?>"><?= $user->twitter; ?></a></p>
        <p>Linkedin: <a href="<?= $user->linkedin; ?>"><?= $user->linkedin; ?></a></p>
        <p>Github: <a href="<?= $user->github; ?>"><?= $user->github; ?></a></p>
    </div>
</div>