<!DOCTYPE html>
<html lang="fr" data-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@latest/css/pico.classless.min.css">
    <title><?= $title ?></title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="?p=post.index">Accueil</a></li>
                <li><a href="?p=page.contact">Contact</a></li>
                <li><a href="?p=page.resume">CV</a></li>
            </ul>
            <ul>
                <?php if ($admin) : ?>
                    <li><a href="?p=admin.post.index">Administration</a></li>
                <?php endif; ?>
                <?php if ($auth) : ?>
                    <li><a href="?p=user.account">Mon compte</a></li>
                    <li><a href="?p=user.signout"><button>Déconnection</button></a></li>

                <?php else : ?>
                    <li><a href="?p=user.signin"><button>Connection</button></a></li>
                    <li><a href="?p=user.signup"><button>Inscription</button></a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <main>

        <?php
        if (isset($_SESSION['flash'])) {
            var_dump($_SESSION['flash']);
            unset($_SESSION['flash']);
        }
        ?>
        <?php if ($admin) : ?>
            <nav>
                <ul>
                    <li>Administration :</li>
                </ul>
                <ul>
                    <li><a href="?p=admin.post.index">Articles</a></li>
                    <li><a href="?p=admin.category.index">Categories</a></li>
                    <li><a href="?p=admin.user.index">Utilisateurs</a></li>
                </ul>
            </nav>
        <?php endif; ?>
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