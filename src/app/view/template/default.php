<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="../public/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../public/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../public/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../public/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="../public/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#00aba9">
    <meta name="theme-color" content="#ffffff">
    <!-- Custom font -->
    <style>
        @import url('https://use.typekit.net/nbt4tpz.css');

        :root {
            --bs-font-sans-serif: 'Proxima Nova', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }

        .mw-500 {
            max-width: 500px;
        }

        .mw-600 {
            max-width: 600px;
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
        <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="?p=page.home"><img src="../public/img/logo.png" alt="Logo" width="30" height="auto"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase fw-light" href="?p=post.index">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="?p=page.resume" class="nav-link text-uppercase fw-light">CV</a>
                    </li>
                    <li class="nav-item">
                        <a href="?p=page.contact" class="nav-link text-uppercase fw-light">Contact</a>
                    </li>
                    <?php if ($admin) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-uppercase fw-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-sliders-h"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=admin.post.index">Articles</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=admin.category.index">Catégories</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=admin.comment.index">Commentaires</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=admin.image.index">Images</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=admin.skill.index">Compétences</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=admin.experience.index">Expériences</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=admin.formation.index">Formation</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=admin.interest.index">Intérêts</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=admin.user.index">Utilisateurs</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=admin.site.index">Configuration</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if ($auth) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-uppercase fw-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=user.show&id=<?= $_SESSION['user_id']; ?>">Votre profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="?p=user.setting&id=<?= $_SESSION['user_id']; ?>">Paramètres</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if ($auth) : ?>
                    <form class="d-flex">
                        <a href="?p=user.signout" class="btn text-uppercase fw-light btn-warning ms-2" type="submit">Déconnexion</a>
                    </form>
                <?php else : ?>
                    <form class="d-flex">
                        <a href="?p=user.signin" class="btn text-uppercase fw-light btn-outline-light" type="submit">Connection</a>
                        <a href="?p=user.signup" class="btn text-uppercase fw-light btn-warning ms-2" type="submit">Inscription</a>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <!-- MAIN -->
    <main class="flex-shrink-0">
        <!-- FLASH -->
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach($_SESSION['flash'] as $type => $message ) : ?>
                <div class="container alert mt-5 alert-<?= $type; ?>">
                    <?= $message; ?>
                </div>
            <?php endforeach; ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>
        <!-- CONTENT -->
        <?= $content; ?>
    </main>
    <!-- FOOTER -->
    <footer class="footer mt-auto py-5 bg-warning">
        <div class="container">
            <ul class="nav flex-row justify-content-center">
                <li class="nav-item mx-5">
                    <a href="#" class="nav-link link-dark px-2">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                </li>
                <li class="nav-item mx-5">
                    <a href="#" class="nav-link link-dark px-2">
                        <i class="fab fa-twitter fa-2x"></i>
                    </a>
                </li>
                <li class="nav-item mx-5">
                    <a href="#" class="nav-link link-dark px-2">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                </li>
            </ul>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7be4a1afd8.js" crossorigin="anonymous"></script>
</body>

</html>