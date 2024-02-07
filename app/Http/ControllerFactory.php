<?php

namespace App\Http;

use Closure;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

class ControllerFactory
{
    /**
     * Call controller from factory
     */
    public static function call(string $controller, string $method): Closure
    {
        $reflection_class = new ReflectionClass($controller);
        $reflection_action = $reflection_class->getMethod($method);
        $reflection_middleware = self::getMiddleware($reflection_class, $method);
        return function () use ($controller, $reflection_action, $reflection_middleware) {
            $middleware_result = isset($reflection_middleware) ? $reflection_middleware->invoke(new $controller()) : [];
            $reflection_action->invokeArgs(new $controller(), $middleware_result);
        };
    }

    /**
     * Get middleware
     */
    public static function getMiddleware(ReflectionClass $controller, string $method): ReflectionMethod | null
    {
        try {
            return $controller->getMethod($method . "Middleware");
        } catch (\Throwable $th) {
            if ($th instanceof ReflectionException) return null;
            throw $th;
        }
    }
}
