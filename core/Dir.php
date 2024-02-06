<?php

namespace Core;

/**
 * Directories
 */
class Dir
{
    public static function root()
    {
        return str_replace("/core", "", __DIR__);
    }

    public static function app()
    {
        return self::root() . "/app";
    }

    public static function cache()
    {
        return self::root() . "/cache";
    }

    public static function core()
    {
        return __DIR__;
    }

    public static function configs()
    {
        return self::root() . "/configs";
    }

    public static function public()
    {
        return self::root() . "/public";
    }

    public static function resources()
    {
        return self::root() . "/resources";
    }

    public static function routes()
    {
        return self::root() . "/routes";
    }

    public static function tools()
    {
        return self::root() . "/tools";
    }
}
