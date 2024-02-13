<?php

namespace App\Http\Middlewares;

use Core\Middleware;

class StartOutputBuffer extends Middleware
{
    public function handle(): void
    {
        ob_start();
    }
}
