<?php

use Core\Dir;

return [
    "symlinks" => [
        Dir::cache() . "/assets" => Dir::public() . "/assets",
    ],
];
