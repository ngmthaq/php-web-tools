<?php

namespace App\Http\Middlewares;

use Core\Dir;
use Core\Middleware;
use Core\Server;
use Exception;

class VerifyCORS extends Middleware
{
    /**
     * Handle Verify CORS
     *
     * @return void
     * @throws Exception
     */
    public function handle(): void
    {
        $app_configs = require(Dir::configs() . "/app.php");
        $cors_configs = $app_configs["cors"];
        $methods = $cors_configs["methods"];
        $origins = $cors_configs["origins"];
        $origin = Server::resolveOrigin();

        if (isset($origin)) {
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400'); // cache for 1 day

            if ($origins === "*") {
                header("Access-Control-Allow-Origin: *");
            } elseif (is_array($origins) && in_array($origin, $origins)) {
                header("Access-Control-Allow-Origin: $origin");
            } else {
                $type = gettype($origins);
                throw new Exception("CORS origins configs must be '*' or array, $type detected");
            }
        }

        if (Server::resolveMethod() === 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                header("Access-Control-Allow-Methods: $methods");
            }

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
            }

            exit;
        }
    }
}
