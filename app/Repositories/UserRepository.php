<?php

namespace App\Repositories;

class UserRepository extends Repository implements UserRepositoryContract
{
    public function test(): string
    {
        return "hello from repository";
    }
}