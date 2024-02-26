<?php

namespace App\Http;

use App\Providers\RepositoryProvider;
use Closure;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use Throwable;

class ControllerFactory
{
    /**
     * Make controller from route configs
     *
     * @param string $controller
     * @param string $method
     * @return Closure
     * @throws ReflectionException
     * @throws Throwable
     */
    public static function make(string $controller, string $method): Closure
    {
        $reflection_class = new ReflectionClass($controller);
        $reflection_constructor = $reflection_class->getConstructor();
        $reflection_action = $reflection_class->getMethod($method);
        $reflection_middleware = self::getMiddleware($reflection_class, $method);
        $reflection_constructor_argv = $reflection_constructor->getParameters();
        $controller_argv = array_map(function ($reflection_constructor_arg) {
            $type = $reflection_constructor_arg->getType()->getName();
            return provider(RepositoryProvider::KEY, $type);
        }, $reflection_constructor_argv);

        return function () use ($reflection_class, $reflection_action, $reflection_middleware, $controller_argv) {
            $controller = $reflection_class->newInstanceArgs($controller_argv);
            $middleware_result = isset($reflection_middleware) ? $reflection_middleware->invoke($controller) : [];
            $reflection_action->invokeArgs($controller, $middleware_result);
        };
    }

    /**
     * Get middleware of the current route
     *
     * @param ReflectionClass $controller
     * @param string $method
     * @return ReflectionMethod|null
     * @throws ReflectionException
     */
    public static function getMiddleware(ReflectionClass $controller, string $method): ReflectionMethod|null
    {
        try {
            return $controller->getMethod($method . "Middleware");
        } catch (Throwable $th) {
            if ($th instanceof ReflectionException) return null;
            throw $th;
        }
    }
}
