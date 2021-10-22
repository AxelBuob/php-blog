<?php
use Core\Auth\Auth;
$auth = new Auth($app->getDB());
$logged = $auth->logged();
?>

<!DOCTYPE html>
<html lang="fr" data-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.classless.min.css">
    <title><?= App\Factory::getFactory()->title; ?></title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php?p=home">Accueil</a></li>
                <li><a href="index.php?p=contact">Contact</a></li>
                <li><a href="index.php?p=resume">CV</a></li>
            </ul>
            <ul>
                <?php if ($logged === false) : ?>
                    <li><a href="index.php?p=signin"><button>Connection</button></a></li>
                    <li><a href="index.php?p=signup"><button>Inscription</button></a></li>
                <?php else : ?>
                    <li><a href="index.php?p=signout"><button>Déconnection</button></a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>
        <?= $content; ?>
    </main>
    <footer>
        <nav>
            <ul>
                <li><strong>Retrouvez-moi sur:</strong></li>
            </ul>
            <ul>
                <li><a href="#">Github</a></li>
                <li><a href="#">Linkedin</a></li>
                <li><a href="#">Twitter</a></li>
            </ul>
        </nav>
    </footer>
</body>

</html>