<?php

namespace App\Http\Middlewares;

use Core\Dir;
use Core\Middleware;
use Dotenv\Dotenv;

class InitEnvironment extends Middleware
{
    /**
     * Init ENV with Dotenv
     */
    public function handle(): void
    {
        $dotenv = Dotenv::createImmutable(Dir::root());
        $dotenv->safeLoad();
    }
}
