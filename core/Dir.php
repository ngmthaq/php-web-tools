<?php

namespace Core;

/**
 * Directories
 */
class Dir
{
    /**
     * Get root dir
     *
     * @return string
     */
    public static function root(): string
    {
        return str_replace("/core", "", __DIR__);
    }

    /**
     * Get app dir
     *
     * @return string
     */
    public static function app(): string
    {
        return self::root() . "/app";
    }

    /**
     * Get cache dir
     *
     * @return string
     */
    public static function cache(): string
    {
        return self::root() . "/cache";
    }

    /**
     * Get core dir
     *
     * @return string
     */
    public static function core(): string
    {
        return __DIR__;
    }

    /**
     * Get configs dir
     *
     * @return string
     */
    public static function configs(): string
    {
        return self::root() . "/configs";
    }

    /**
     * Get public dir
     *
     * @return string
     */
    public static function public(): string
    {
        return self::root() . "/public";
    }

    /**
     * Get resources dir
     *
     * @return string
     */
    public static function resources(): string
    {
        return self::root() . "/resources";
    }

    /**
     * Get routes dir
     *
     * @return string
     */
    public static function routes(): string
    {
        return self::root() . "/routes";
    }

    /**
     * Get tools dir
     *
     * @return string
     */
    public static function tools(): string
    {
        return self::root() . "/tools";
    }
}
