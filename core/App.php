<?php

namespace Core;

use App\Http\Exceptions\NotFoundException;

class App
{
    public array $routes;

    public function __construct()
    {
        $this->routes = require_once(Dir::configs() . "/routes.php");
    }

    public function preload()
    {
        session_start();
        ob_start();
    }

    public function run()
    {
        try {
            $route = $this->getCurrentRoute();
            return $route->resolvePath();
        } catch (\Throwable $th) {
            Debug::printR($th->getTrace());
        }
    }

    public function getCurrentRoute()
    {
        $current_route = null;
        foreach ($this->routes as $route) {
            if ($route->isMatching()) {
                $current_route = $route;
                break;
            }
        }
        if (empty($current_route)) throw new NotFoundException();
        return $current_route;
    }
}
