<?php

namespace Core;

use App\Exceptions\NotFoundException;

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

    /**
     * Prevent XSS from user request
     */
    public static function preventXSS(array $params): array
    {
        $output = [];
        foreach ($params as $key => $value) {
            if (gettype($value) === "string") {
                $output[$key] = htmlentities(trim($value));
            } else if (gettype($value) === "array") {
                $output[$key] = self::preventXSS($value);
            } else {
                $output[$key] = $value;
            }
        }
        return $output;
    }

    /**
     * Get query paramaters
     */
    public static function query(string | null $key = null)
    {
        $queries = self::preventXSS($_GET);
        if (empty($key)) return $queries;
        if (empty($queries[$key])) return null;
        return $queries[$key];
    }

    /**
     * Get input paramaters
     */
    public static function input(string | null $key = null)
    {
        $inputs = self::preventXSS($_POST);
        if (empty($key)) return $inputs;
        if (empty($inputs[$key])) return null;
        return $inputs[$key];
    }

    /**
     * Get URL paramaters
     */
    public static function param(int | null $key = null)
    {
        $params = self::resolveParams();
        $params = self::preventXSS($params);
        if ($key === null) return $params;
        if (empty($params[$key])) return null;
        return $params[$key];
    }

    /**
     * Get FILES
     */
    public static function files()
    {
        return $_FILES;
    }

    /**
     * Get request cookies
     */
    public static function cookie(string | null $key = null)
    {
        $cookies = self::preventXSS($_COOKIE);
        if (empty($key)) return $cookies;
        if (empty($cookies[$key])) return null;
        return $cookies[$key];
    }
}
