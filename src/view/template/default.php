<!DOCTYPE html>
<html lang="fr" data-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.classless.min.css">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../public/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="194x194" href="../public/img/favicon/f/public/img/faviconavicon-194x194.png">
    <link rel="icon" type="image/png" sizes="192x192" href="../public/img/favicon/android-chrome-192x192.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../public/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../public/img/favicon/site.webmanifest">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">
    <title><?= App\Factory::getFactory()->title; ?></title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="?p=home">Accueil</a></li>
                <li><a href="?p=contact">Contact</a></li>
                <li><a href="?p=resume">CV</a></li>
            </ul>
            <ul>
                <li><a href="?p=signin"><button>Connection</button></a></li>
                <li><a href="?p=signup"><button>Inscription</button></a></li>
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