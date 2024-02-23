<?php

namespace Core;

class Server
{
    /**
     * Get current path name
     *
     * @return string
     */
    public static function resolvePath(): string
    {
        $redirect_url = $_SERVER['REDIRECT_URL'];
        return str_replace('/public', '', $redirect_url);
    }

    /**
     * Get current method
     *
     * @return string
     */
    public static function resolveMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Resolve request origin
     *
     * @return string|null
     */
    public static function resolveOrigin(): string|null
    {
        return $_SERVER['HTTP_ORIGIN'];
    }
}
