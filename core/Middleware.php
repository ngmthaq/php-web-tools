<?php

namespace Core;

abstract class Middleware
{
    /**
     * @return void
     */
    abstract public function handle(): void;
}
