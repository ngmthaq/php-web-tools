<?php

namespace Core;

use App\Http\Exceptions\NotFoundException;

class App
{
    public array $routes;
    public I18n $i18n;

    public function __construct()
    {
        $this->routes = require_once(Dir::configs() . "/routes.php");
        $this->i18n = new I18n();
    }

    public function preload()
    {
        session_start();
        ob_start();
        $this->i18n->init();
    }

    public function run()
    {
        try {
            $route = $this->getCurrentRoute();
            return $route->resolvePath();
        } catch (\Throwable $th) {
            Debug::printR($th);
        }
    }

    public function getCurrentRoute()
    {
        $current_route = null;
        foreach ($this->routes as $route) if ($route->isMatching()) $current_route = $route;
        if (empty($current_route)) throw new NotFoundException();
        return $current_route;
    }
}
