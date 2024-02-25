<?php

namespace App\Http\Middlewares;

use App\Exceptions\BadRequestException;
use Core\Middleware;
use Core\Request;
use Core\Server;
use Core\Str;
use Exception;

class VerifyCSRF extends Middleware
{
    public const SESSION_KEY = "_x_csrf_token";

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
            $_SESSION[self::SESSION_KEY] = Str::random();
        }

        // Check XSRF Token
        $route = Request::getCurrentRoute();
        if (!$route->isSkipXSRF()
            && Server::resolveMethod() !== "GET"
            && (empty(Request::input(self::SESSION_KEY)) || Request::input(self::SESSION_KEY) !== $_SESSION[self::SESSION_KEY])) {
            throw new BadRequestException(isProd()
                ? "CSRF Token Mismatch"
                : "CSRF Token Mismatch. Attach '" . self::SESSION_KEY . ": " . $_SESSION[self::SESSION_KEY] . "' in your request body");
        }
    }
}
