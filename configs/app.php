<?php

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
        \App\Http\Middlewares\StartSession::class,
        \App\Http\Middlewares\StartOutputBuffer::class,
        \App\Http\Middlewares\InitEnvironment::class,
        \App\Http\Middlewares\InitI18n::class,
        \App\Http\Middlewares\VerifyCSRF::class,
        \App\Http\Middlewares\LimitRequest::class,
    ],
];
