<?php

/**
 * Clear Blade Template Engine data cached in cache/views
 */

use Core\Dir;

require_once("./vendor/autoload.php");

$dir = Dir::cache() . "/views";

echo shell_exec("./vendor/bin/bladeonecli -compilepath $dir -clearcompile");
