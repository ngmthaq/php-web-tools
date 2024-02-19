<?php

namespace App\Http\Middlewares;

use Core\Dir;
use Core\Middleware;
use Dotenv\Dotenv;

class InitEnvironment extends Middleware
{
    /**
     * Handle load .env file to $_ENV
     *
     * @return void
     */
    public function handle(): void
    {
        $dotenv = Dotenv::createImmutable(Dir::root());
        $dotenv->safeLoad();
    }
}
