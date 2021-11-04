<div class="container mt-5">
    <h1><?= $user->first_name; ?> <?= $user->last_name; ?></h1>
    <h2 class="lead text-muted"><?= $user->about; ?></h2>
    <div class="my-3">
        <p>Twitter: <a  class="link-dark"href="<?= $user->twitter; ?>"><?= $user->twitter; ?></a></p>
        <p>Linkedin: <a  class="link-dark"href="<?= $user->linkedin; ?>"><?= $user->linkedin; ?></a></p>
        <p>Github: <a class="link-dark" href="<?= $user->github; ?>"><?= $user->github; ?></a></p>
    </div>
</div>