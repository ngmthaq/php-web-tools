<?php

namespace App\Http\Middlewares;

use Core\Middleware;

class StartSession extends Middleware
{
    /**
     * @return void
     */
    public function handle(): void
    {
        session_start();
    }
}
