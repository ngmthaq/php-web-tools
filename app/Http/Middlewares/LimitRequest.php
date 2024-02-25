<?php

namespace App\Http\Middlewares;

use App\Exceptions\ThrottleException;
use Core\Dir;
use Core\Middleware;

class LimitRequest extends Middleware
{
    public const SESSION_KEY = "_throttle_requests";

    /**
     * Handle limit request per minute
     *
     * @return void
     * @throws ThrottleException
     */
    public function handle(): void
    {
        if (isProd()) {
            if (empty($_SESSION[self::SESSION_KEY])) {
                $_SESSION[self::SESSION_KEY] = [
                    "timestamp" => time(),
                    "number" => 1,
                ];
            } else {
                $current_time = time();
                $throttle_start_time = $_SESSION[self::SESSION_KEY]["timestamp"];

                if ($current_time - $throttle_start_time > 60) {
                    $_SESSION[self::SESSION_KEY] = [
                        "timestamp" => $current_time,
                        "number" => 1,
                    ];
                } else {
                    $_SESSION[self::SESSION_KEY]["number"] += 1;
                }

                $app_configs = require(Dir::configs() . "/app.php");
                $throttle_configs = $app_configs["throttle"];
                if ($_SESSION[self::SESSION_KEY]["number"] > $throttle_configs) {
                    throw new ThrottleException();
                }
            }
        }
    }
}
