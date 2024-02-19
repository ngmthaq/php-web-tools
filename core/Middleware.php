<?php

namespace Core;

abstract class Middleware
{
    /**
     * Handle middleware
     *
     * @return void
     */
    abstract public function handle(): void;
}
