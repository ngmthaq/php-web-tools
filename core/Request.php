<?php

namespace Core;

use App\Exceptions\NotFoundException;

class Request
{
    /**
     * Get query string parameters
     *
     * @param string|null $key
     * @return array|mixed|null
     */
    public static function query(string|null $key = null): mixed
    {
        $queries = self::preventXSS($_GET);
        if (empty($key)) return $queries;
        if (empty($queries[$key])) return null;
        return $queries[$key];
    }

    /**
     * Quick prevent XSS attack
     *
     * @param array $params
     * @return array
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
     * Get data from FormData
     *
     * @param string|null $key
     * @return array|mixed|null
     */
    public static function input(string|null $key = null): mixed
    {
        $inputs = self::preventXSS($_POST);
        if (empty($key)) return $inputs;
        if (empty($inputs[$key])) return null;
        return $inputs[$key];
    }

    /**
     * Get params from URL
     *
     * @param int|null $key
     * @return array|mixed|null
     * @throws NotFoundException
     */
    public static function param(int|null $key = null): mixed
    {
        $params = self::resolveParams();
        $params = self::preventXSS($params);
        if ($key === null) return $params;
        if (empty($params[$key])) return null;
        return $params[$key];
    }

    /**
     * Resolve params from url
     *
     * @return array
     * @throws NotFoundException
     */
    public static function resolveParams(): array
    {
        $route = self::getCurrentRoute();
        return $route->resolveParams();
    }

    /**
     * Get current route
     *
     * @return Route
     * @throws NotFoundException
     */
    public static function getCurrentRoute(): Route
    {
        $current_route = null;
        foreach (self::routes() as $route) if ($route->isMatching()) $current_route = $route;
        if (empty($current_route)) throw new NotFoundException();
        return $current_route;
    }

    /**
     * Get all routes
     *
     * @return array
     */
    public static function routes(): array
    {
        return require(Dir::configs() . "/routes.php");
    }

    /**
     * Get files from multipart/form-data
     *
     * @return array
     */
    public static function files(): array
    {
        return $_FILES;
    }

    /**
     * Get request cookie data
     *
     * @param string|null $key
     * @return array|mixed|null
     */
    public static function cookie(string|null $key = null): mixed
    {
        $cookies = self::preventXSS($_COOKIE);
        if (empty($key)) return $cookies;
        if (empty($cookies[$key])) return null;
        return $cookies[$key];
    }
}
