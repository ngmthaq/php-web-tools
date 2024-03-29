<?php

namespace Core;

class Server
{
    public const PREV_PATH_KEY = "_prev_path_for_validation";

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

    /**
     * Get client ip address
     *
     * @return string
     */
    public static function getClientIp(): string
    {
        return $_SERVER['HTTP_CLIENT_IP']
            ?? $_SERVER['HTTP_X_FORWARDED_FOR']
            ?? $_SERVER['HTTP_X_FORWARDED']
            ?? $_SERVER['HTTP_FORWARDED_FOR']
            ?? $_SERVER['HTTP_FORWARDED']
            ?? $_SERVER['REMOTE_ADDR']
            ?? 'UNKNOWN';
    }
}
