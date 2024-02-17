<?php

namespace App\Http;

use Closure;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Throwable;

class ControllerFactory
{
    /**
     * @param string $controller
     * @param string $method
     * @return Closure
     * @throws ReflectionException
     * @throws Throwable
     */
    public static function make(string $controller, string $method): Closure
    {
        $reflection_class = new ReflectionClass($controller);
        $reflection_action = $reflection_class->getMethod($method);
        $reflection_middleware = self::getMiddleware($reflection_class, $method);
        return function () use ($controller, $reflection_action, $reflection_middleware) {
            $middleware_result = isset($reflection_middleware) ? $reflection_middleware->invoke(new $controller) : [];
            $reflection_action->invokeArgs(new $controller, $middleware_result);
        };
    }

    /**
     * @param ReflectionClass $controller
     * @param string $method
     * @return ReflectionMethod|null
     * @throws ReflectionException
     */
    public static function getMiddleware(ReflectionClass $controller, string $method): ReflectionMethod | null
    {
        try {
            return $controller->getMethod($method . "Middleware");
        } catch (Throwable $th) {
            if ($th instanceof ReflectionException) return null;
            throw $th;
        }
    }
}
