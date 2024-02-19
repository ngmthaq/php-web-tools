<?php

namespace App\Http\Middlewares;

use Core\Middleware;

class StartSession extends Middleware
{
    /**
     * Handle start session
     *
     * @return void
     */
    public function handle(): void
    {
        session_start();
    }
}
