<?php

namespace Core;

class Server
{
    /**
     * Get current path (not includes query string)
     */
    public static function resolvePath()
    {
        $redirect_url = $_SERVER['REDIRECT_URL'];
        return str_replace('/public', '', $redirect_url);
    }

    /**
     * Get current request method
     */
    public static function resolveMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
