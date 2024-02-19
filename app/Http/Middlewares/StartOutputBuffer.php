<?php

namespace App\Http\Middlewares;

use Core\Middleware;

class StartOutputBuffer extends Middleware
{
    /**
     * Handle start collect output buffer
     *
     * @return void
     */
    public function handle(): void
    {
        ob_start();
    }
}
