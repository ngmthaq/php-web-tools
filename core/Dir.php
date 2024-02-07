<?php

namespace Core;

/**
 * Directories
 */
class Dir
{
    public static function root(): string
    {
        return str_replace("/core", "", __DIR__);
    }

    public static function app(): string
    {
        return self::root() . "/app";
    }

    public static function cache(): string
    {
        return self::root() . "/cache";
    }

    public static function core(): string
    {
        return __DIR__;
    }

    public static function configs(): string
    {
        return self::root() . "/configs";
    }

    public static function public(): string
    {
        return self::root() . "/public";
    }

    public static function resources(): string
    {
        return self::root() . "/resources";
    }

    public static function routes(): string
    {
        return self::root() . "/routes";
    }

    public static function tools(): string
    {
        return self::root() . "/tools";
    }
}
