<?php

namespace App\Http\Middlewares;

use App\Exceptions\BadRequestException;
use Core\Middleware;
use Core\Request;
use Core\Server;
use Exception;

class VerifyCSRF extends Middleware
{
    public const SESSION_KEY = "X-CSRF-TOKEN";

    /**
     * Handle Verify CSRF
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        // Init XSRF Token
        if (empty($_SESSION[self::SESSION_KEY])) {
            $_SESSION[self::SESSION_KEY] = randomString(64);
        }

        // Check XSRF Token
        if (Server::resolveMethod() !== "GET"
            && (empty(Request::input(self::SESSION_KEY))
                || Request::input(self::SESSION_KEY) !== $_SESSION[self::SESSION_KEY])) {
            throw new BadRequestException("CSRF token mismatch");
        }
    }
}
