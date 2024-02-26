<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryContract;

class RepositoryProvider extends AppProvider
{
    public const KEY = "repository_provider";

    public function setKey(): string
    {
        return self::KEY;
    }

    public function register(): void
    {
        $this->bind(UserRepositoryContract::class, UserRepository::class);
    }
}