<?php

/**
 * Application Configs
 */

use App\Http\Middlewares\CheckServerStatus;
use App\Http\Middlewares\InitEnvironment;
use App\Http\Middlewares\InitI18n;
use App\Http\Middlewares\LimitRequest;
use App\Http\Middlewares\RestApi;
use App\Http\Middlewares\StartOutputBuffer;
use App\Http\Middlewares\StartSession;
use App\Http\Middlewares\VerifyCORS;
use App\Http\Middlewares\VerifyCSRF;

return [
    /**
     * Create Symlinks with PHP Tools
     */
    "symlinks" => [],

    /**
     * Global middlewares
     */
    "middlewares" => [
        RestApi::class,
        StartSession::class,
        StartOutputBuffer::class,
        InitEnvironment::class,
        CheckServerStatus::class,
        InitI18n::class,
        VerifyCSRF::class,
        VerifyCORS::class,
        LimitRequest::class,
    ],

    /**
     * CORS configs
     */
    "cors" => [
        "methods" => "*",
        "origins" => "*",
    ],

    /**
     * Throttle configs (request per minute)
     */
    "throttle" => 30,

    /**
     * Cipher method
     */
    "cipher_method" => "AES-256-CBC",
];
