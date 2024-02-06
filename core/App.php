<?php

namespace Core;

use App\Http\Exceptions\NotFoundException;
use Dotenv\Dotenv;

class App
{
    /**
     * Route List
     */
    public array $routes;

    /**
     * I18n Configs
     */
    public I18n $i18n;

    public function __construct()
    {
        $this->routes = require_once(Dir::configs() . "/routes.php");
        $this->i18n = new I18n();
    }

    /**
     * Init ENV with Dotenv
     */
    public function initialEnv()
    {
        $dotenv = Dotenv::createImmutable(Dir::root());
        $dotenv->safeLoad();
    }

    /**
     * Preload
     */
    public function preload()
    {
        session_start();
        ob_start();
        $this->initialEnv();
        $this->i18n->init();
    }

    /**
     * Run application
     */
    public function run()
    {
        try {
            $route = $this->getCurrentRoute();
            return $route->resolvePath();
        } catch (\Throwable $th) {
            Debug::printR($th);
        }
    }

    /**
     * Get Current Route
     */
    public function getCurrentRoute()
    {
        $current_route = null;
        foreach ($this->routes as $route) if ($route->isMatching()) $current_route = $route;
        if (empty($current_route)) throw new NotFoundException();
        return $current_route;
    }
}
