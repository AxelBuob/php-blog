<?php

// Namespaces
use \App\Factory;

// ROOT folder : /Users/axel/Sites/php-blog
define('ROOT', dirname(__DIR__));
define('UPLOAD_DIR', ROOT . '/public/uploads/');
define('URL_IMAGE', './uploads/');

//define('HOST', $_SERVER['HTTP_ORIGIN']);
//define('SITE_DIR', '/portofolio');

// BYTES TO HUMAN READABLE
define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

// Autoloading
require ROOT . '/src/app/Factory.php';
Factory::autoloading();

// Router
if (isset($_GET['p'])) {
    $p = $_GET['p'];
} else {
    $p = 'post.index';
}

$p = explode('.', $p);

if($p[0] === 'admin')
{
    $controller = '\App\Controller\Admin\\' . ucfirst($p[1]) . 'Controller';
    $action = $p[2];
}
else
{
    $controller = '\App\Controller\\' . ucfirst($p[0]) . 'Controller';
    $action = $p[1];
}

$controller = new $controller;
$controller->$action();