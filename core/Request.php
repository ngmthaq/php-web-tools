<?php

namespace Core;

use App\Http\Exceptions\NotFoundException;

class Request
{
    /**
     * Route List
     */
    public static function routes(): array
    {
        $routes = require(Dir::configs() . "/routes.php");
        return $routes;
    }

    /**
     * Get Current Route
     */
    public static function getCurrentRoute(): Route
    {
        $current_route = null;
        foreach (self::routes() as $route) if ($route->isMatching()) $current_route = $route;
        if (empty($current_route)) throw new NotFoundException();
        return $current_route;
    }

    /**
     * Resolve URL Params
     */
    public static function resolveParams(): array
    {
        $route = self::getCurrentRoute();
        return $route->resolveParams();
    }

    public static function preventXSS(array $params): array
    {
        $output = [];
        foreach ($params as $key => $value) {
            if (gettype($value) == "string") {
                $output[$key] = htmlentities(trim($value));
            } else if (gettype($value) == "array") {
                $output[$key] = self::preventXSS($value);
            } else {
                $output[$key] = $value;
            }
        }
        return $output;
    }
}
