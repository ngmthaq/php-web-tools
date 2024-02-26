<?php

namespace App\Providers;

use Core\Response;
use Exception;

abstract class AppProvider
{
    public const GLOBAL_KEY = "_app_providers";

    public string $key;
    public array $services;

    public function __construct()
    {
        $this->services = [];
        $this->key = $this->setKey();
        $this->register();
    }

    /**
     * Set provider global key
     *
     * @return string
     */
    abstract public function setKey(): string;

    /**
     * Register providers
     *
     * @return void
     */
    abstract public function register(): void;

    /**
     * Binding provider
     *
     * @param string $contract
     * @param string $class
     * @return void
     */
    public function bind(string $contract, string $class): void
    {
        $this->services[$contract] = ["class" => $class, "instance" => null];
    }

    /**
     * Resolve provider
     *
     * @param string $repository_contract
     * @return mixed
     * @throws Exception
     */
    public function resolve(string $repository_contract): mixed
    {
        $configs = $this->services[$repository_contract];
        if (empty($configs)) throw new Exception("Contract not found: $repository_contract", Response::STT_INTERNAL_SERVER_ERROR);
        if (isset($configs["instance"])) return $configs["instance"];
        $instance = new $configs["class"];
        $this->services[$repository_contract]["instance"] = $instance;
        return $instance;
    }
}