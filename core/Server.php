<?php

namespace Core;

class Server
{
    /**
     * @return string
     */
    public static function resolvePath(): string
    {
        $redirect_url = $_SERVER['REDIRECT_URL'];
        return str_replace('/public', '', $redirect_url);
    }

    /**
     * @return string
     */
    public static function resolveMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
