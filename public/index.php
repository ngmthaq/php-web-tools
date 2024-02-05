<?php

use Core\App;

require_once("../vendor/autoload.php");

$app = new App();
$app->preload();
$app->run();
