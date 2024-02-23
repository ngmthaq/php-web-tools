<?php

use Core\Dir;

require_once("./vendor/autoload.php");

$mode = $argv[1];

$placeholder_file = Dir::root() . "/.prod";

echo "\n";

if (!$mode) {
    echo ">>> Please provide build mode (dev | prod) \n \n";
    exit;
}

if ($mode !== "dev" && $mode !== "prod") {
    echo ">>> Please provide build mode (dev | prod) \n \n";
    exit;
}

echo ">>> yarn install \n \n";
echo shell_exec("yarn install");
echo "\n";

echo ">>> composer install \n \n";
echo shell_exec("composer install");
echo "\n";

if (file_exists($placeholder_file)) {
    echo ">>> Unlink " . $placeholder_file . "\n \n";
    unlink($placeholder_file);
}

if ($mode === "prod") {
    echo ">>> Touch " . $placeholder_file . "\n \n";
    touch($placeholder_file);
    echo ">>> yarn build \n \n";
    echo shell_exec("yarn build");
} else {
    echo ">>> yarn dev \n \n";
    echo shell_exec("yarn dev");
}

echo "\n";
