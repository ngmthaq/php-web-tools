<?php

use App\Kernel;

require_once("../vendor/autoload.php");

$app = new Kernel();
$app->preload();
$app->run();
