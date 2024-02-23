<?php

namespace App\Http\Middlewares;

use App\Exceptions\ServiceUnavailableException;
use Core\Middleware;

class CheckServerStatus extends Middleware
{
    /**
     * Handle check server status
     *
     * @return void
     * @throws ServiceUnavailableException
     */
    public function handle(): void
    {
        if ($_ENV["APP_AVAILABLE"] !== "true") {
            throw new ServiceUnavailableException();
        }
    }
}
