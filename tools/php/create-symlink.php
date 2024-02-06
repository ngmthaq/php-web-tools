<?php

/**
 * Create symlink match with config of configs/app.php
 */

use Core\Dir;

require_once("./vendor/autoload.php");

$app_configs = require_once(Dir::configs() . "/app.php");

$symlinks = $app_configs["symlinks"];

foreach ($symlinks as $target => $link) {
    if (file_exists($link) && is_link($link)) unlink($link);
    $output = symlink($target, $link);
    echo $output
        ? "\n >>> Symlink $target => $link has been created! \n \n"
        : "\n >>> Symlink $target => $link cannot be created! \n \n";
}
