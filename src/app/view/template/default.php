<!DOCTYPE html>
<html lang="<?= ($config->language) ? $config->language : "fr"; ?>" class="h-100">

<head>
    <meta charset="<?= ($config->charset) ? $config->charset : "UTF-8"; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= ($title) ? $title : $config->name; ?></title>
    <meta name="description" content="<?= ($config->description) ?: $config->description; ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.6" media="print">
    <link rel="stylesheet" href="https://unpkg.com/gutenberg-css@0.6/dist/themes/oldstyle.min.css" media="print">
    <!-- Favicon -->
    <link rel="icon" type="image/ico" sizes="16x16" href="/portofolio/public/favicon.ico">
    <link rel="manifest" href="/portofolio/public/site.webmanifest">
    <!-- Custom font -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,300;0,400;0,700;1,400&display=swap');

        :root {
            --bs-font-sans-serif: 'Roboto Mono', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
    </style>
</head>

<body class="d-flex flex-column h-100">
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/portofolio/">
                <?php if($config->logo_path) : ?>
                <img src="<?= ($config->logo_path) ?: $config->logo_path; ?> " alt="Logo" width="30" height="auto">
                <?php else: ?>
                    <img src="/portofolio/public/img/logo.png" alt="Logo" width="30" height="auto">
                <?php endif; ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase fw-light" href="/portofolio">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="/portofolio/page/resume" class="nav-link text-uppercase fw-light">CV</a>
                    </li>
                    <li class="nav-item">
                        <a href="/portofolio/page/contact" class="nav-link text-uppercase fw-light">Contact</a>
                    </li>
                    <?php if ($admin) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-uppercase fw-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-sliders-h"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/admin/post">Articles</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/admin/category">Catégories</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/admin/comment">Commentaires</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/admin/skill">Compétences</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/admin/experience">Expériences</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/admin/formation">Formation</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/admin/interest">Intérêts</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/admin/user/">Utilisateurs</a></li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/admin/site/">Configuration</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if ($auth) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link text-uppercase fw-light dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/user/show/?id=<?= $_SESSION['user_id']; ?>">Votre profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-uppercase fw-light" href="/portofolio/user/setting/?id=<?= $_SESSION['user_id']; ?>">Paramètres</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if ($auth) : ?>
                    <form class="d-flex">
                        <a href="/portofolio/user/signout" class="btn text-uppercase fw-light btn-warning ms-2" type="submit">Déconnexion</a>
                    </form>
                <?php else : ?>
                    <form class="d-flex">
                        <a href="/portofolio/user/signin" class="btn text-uppercase fw-light btn-outline-light" type="submit">Connexion</a>
                        <a href="/portofolio/user/signup" class="btn text-uppercase fw-light btn-warning ms-2" type="submit">Inscription</a>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <!-- MAIN -->
    <main class="flex-shrink-0">
        <!-- FLASH -->
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
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
    <footer class="footer mt-auto py-3 bg-warning">
        <div class="text-center container">
            <ul class="nav flex-row justify-content-center mb-3">
                <li class="nav-item mx-3">
                    <a href="<?= ($config->github) ?: $config->github; ?>" class="nav-link link-dark px-2">
                        <i class="fab fa-github fa-2x"></i>
                    </a>
                </li>
                <li class="nav-item mx-3">
                    <a href="<?= ($config->github) ?: $config->twitter; ?>" class="nav-link link-dark px-2">
                        <i class="fab fa-twitter fa-2x"></i>
                    </a>
                </li>
                <li class="nav-item mx-3">
                    <a href="<?= ($config->github) ?: $config->linkedin; ?>" class="nav-link link-dark px-2">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                </li>
            </ul>
            <a class="link-dark my-5" href="/portofolio/admin/">Administration</a>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/7be4a1afd8.js" crossorigin="anonymous"></script>
</body>
</html>
