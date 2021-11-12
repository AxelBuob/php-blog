<?php

use \App\Factory;
use \App\Router;

define('ROOT', dirname(__DIR__));
define('BASE_DIR', 'portofolio');
define('UPLOAD_DIR', ROOT . '/public/uploads/');
define('UPLOAD_PATH', '/portofolio/public/uploads/');

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

require '../vendor/autoload.php';
require ROOT . '/src/app/Factory.php';
Factory::autoloading();

$router = new Router(BASE_DIR);
$router->init();






