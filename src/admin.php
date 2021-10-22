<?php
// Namespaces
use \App\Factory;
use \Core\Auth\Auth;

// ROOT folder : /Users/axel/Sites/php-blog
define('ROOT', dirname(__DIR__));

// Autoloading
require ROOT . '/src/app/Factory.php';
Factory::autoloading();

// Factory
$app = Factory::getFactory();

$auth = new Auth($app->getDB());
if(!$auth->logged())
{
    $app->forbidden();
}


// Router
if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'post.index';
}

ob_start();
if ($p === 'post.index') {
    require(ROOT . '/src/view/admin/post/index.php');
} elseif ($p === 'post.edit') {
    require(ROOT . '/src/view/admin/post/edit.php');
} elseif ($p === 'post.add') {
    require(ROOT . '/src/view/admin/post/add.php');
} elseif ($p === 'post.delete') {
    require(ROOT . '/src/view/admin/post/delete.php');
} elseif ($p === 'category.index') {
    require(ROOT . '/src/view/admin/category/index.php');
} elseif ($p === 'category.edit') {
    require(ROOT . '/src/view/admin/category/edit.php');
} elseif ($p === 'category.add') {
    require(ROOT . '/src/view/admin/category/add.php');
} elseif ($p === 'category.delete') {
    require(ROOT . '/src/view/admin/category/delete.php');
} else {
    require(ROOT . '/src/view/error/404.php');
}
$content = ob_get_clean();
require(ROOT . '/src/view/template/default.php');
