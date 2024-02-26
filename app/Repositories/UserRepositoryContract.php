<?php

namespace App\Repositories;

interface UserRepositoryContract extends RepositoryContract
{
    public function test(): string;
}