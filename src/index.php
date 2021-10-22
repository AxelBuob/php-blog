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
if(isset($_GET['p'])) {
    $p = $_GET['p'];
}
else
{
    $p = 'home';
}

ob_start();
if( $p === 'home')
{
    require(ROOT . '/src/view/home.php');
}
else
{
    require(ROOT . '/src/view/404.php');
}
$content = ob_get_clean();
require(ROOT . '/src/view/template/default.php');
