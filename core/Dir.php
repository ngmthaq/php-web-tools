<?php

namespace Core;

/**
 * Directories
 */
class Dir
{
    /**
     * @return string
     */
    public static function root(): string
    {
        return str_replace("/core", "", __DIR__);
    }

    /**
     * @return string
     */
    public static function app(): string
    {
        return self::root() . "/app";
    }

    /**
     * @return string
     */
    public static function cache(): string
    {
        return self::root() . "/cache";
    }

    /**
     * @return string
     */
    public static function core(): string
    {
        return __DIR__;
    }

    /**
     * @return string
     */
    public static function configs(): string
    {
        return self::root() . "/configs";
    }

    /**
     * @return string
     */
    public static function public(): string
    {
        return self::root() . "/public";
    }

    /**
     * @return string
     */
    public static function resources(): string
    {
        return self::root() . "/resources";
    }

    /**
     * @return string
     */
    public static function routes(): string
    {
        return self::root() . "/routes";
    }

    /**
     * @return string
     */
    public static function tools(): string
    {
        return self::root() . "/tools";
    }
}
