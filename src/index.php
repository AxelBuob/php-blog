<?php
// Namespaces
use \App\Factory;

// ROOT folder : /Users/axel/Sites/php-blog
define('ROOT', dirname(__DIR__));

// Autoloading
require ROOT . '/src/app/Factory.php';
Factory::autoloading();

// Factory
$app = Factory::getFactory();

// Router
if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'home';
}

ob_start();
if ($p === 'home') {
    require(ROOT . '/src/view/page/home.php');
} elseif ($p === 'post') {
    require(ROOT . '/src/view/blog/post.php');
} elseif ($p === 'category') {
    require(ROOT . '/src/view/blog/category.php');
} elseif ($p === 'contact') {
    require(ROOT . '/src/view/page/contact.php');
} elseif ($p === 'resume') {
    require(ROOT . '/src/view/page/resume.php');
} elseif ($p === 'signin') {
    require(ROOT . '/src/view/user/signin.php');
} elseif ($p === 'signup') {
    require(ROOT . '/src/view/user/signup.php');
} elseif ($p === 'signout') {
    require(ROOT . '/src/view/user/signout.php');
} elseif($p === '403') {
    require(ROOT . '/src/view/error/403.php');
} else {
    require(ROOT . '/src/view/error/404.php');
}
$content = ob_get_clean();
require(ROOT . '/src/view/template/default.php');
