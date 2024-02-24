<?php

namespace Core;

class Server
{
    public const PREV_PATH_KEY = "PREV-PATH-FOR-VALIDATION";

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
     * Get full path
     *
     * @return string
     */
    public static function resolveFullPath(): string
    {
        return $_SERVER['REQUEST_URI'];
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
