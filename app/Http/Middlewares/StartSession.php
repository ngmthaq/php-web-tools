<?php

namespace App\Http\Middlewares;

use Core\Middleware;

class StartSession extends Middleware
{
    public function handle(): void
    {
        session_start();
    }
}
