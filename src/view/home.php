<?php

use App\Factory;

$app = Factory::getFactory();
$db = Factory::getFactory()->getDB();

var_dump($db);