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
    require(ROOT . '/src/view/page/home.php');
}
elseif($p === 'post')
{
    require(ROOT . '/src/view/post/post.php');
}
elseif($p === 'category')
{
    require(ROOT . '/src/view/page/category.php');
}
elseif($p === 'contact')
{
    require(ROOT . '/src/view/form/contact.php'); 
}
elseif($p === 'resume')
{
    require(ROOT . '/src/view/page/resume.php'); 
}
elseif($p === 'signin')
{
    require(ROOT . '/src/view/form/signin.php'); 
}
elseif($p === 'signup')
{
    require(ROOT . '/src/view/form/signup.php');
}
else
{
    require(ROOT . '/src/view/error/404.php');
}
$content = ob_get_clean();
require(ROOT . '/src/view/template/default.php');
