<?php

use \App\Factory;
use \App\Router;
use samdark\sitemap\Sitemap;

define('ROOT', dirname(__DIR__));
define('BASE_DIR', 'portofolio');
define('UPLOAD_DIR', ROOT . '/public/uploads/');
define('UPLOAD_PATH', '/portofolio/public/uploads/');
define('HOST', 'http://localhost/portofolio/');

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

require '../vendor/autoload.php';
require ROOT . '/src/app/Factory.php';
Factory::autoloading();

$router = new Router(BASE_DIR);
$router->init();

// Sitemap
$sitemap = new Sitemap(__DIR__ . '/sitemap.xml');
// Page
$sitemap->addItem(HOST . '/page/contact',);
$sitemap->addItem(HOST . '/page/resume');
// USER
$sitemap->addItem(HOST . '/user/signin');
$sitemap->addItem(HOST . '/user/signout');
$sitemap->addItem(HOST . '/user/forget');
$sitemap->addItem(HOST . '/user/show/?id=1');

// POST
$sitemap->addItem(HOST . '/post/show/?id=3');
$sitemap->addItem(HOST . '/post/show/?id=15');
$sitemap->addItem(HOST . '/post/show/?id=16');

// POST
$sitemap->addItem(HOST . '/post/category/?id=1');
$sitemap->addItem(HOST . '/post/category/?id=2');
$sitemap->addItem(HOST . '/post/category/?id=3');

$sitemap->write();
$sitemapFileUrls = $sitemap->getSitemapUrls('http://localhost/portofolio/');












