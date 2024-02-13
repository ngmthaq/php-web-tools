<?php

use App\Http\Middlewares\InitEnvironment;
use App\Http\Middlewares\InitI18n;
use App\Http\Middlewares\StartOutputBuffer;
use App\Http\Middlewares\StartSession;

/**
 * Application Configs
 */

return [
    /**
     * Create Symlinks with PHP Tools
     */
    "symlinks" => [],

    /**
     * Global middlewares
     */
    "middlewares" => [
        StartSession::class,
        StartOutputBuffer::class,
        InitEnvironment::class,
        InitI18n::class,
    ],
];
