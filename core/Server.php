<?php

namespace Core;

class Server
{
    public static function resolvePath()
    {
        $redirect_url = $_SERVER['REDIRECT_URL'];
        return str_replace('/public', '', $redirect_url);
    }

    public static function resolveMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}
