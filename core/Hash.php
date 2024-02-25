<?php

namespace Core;

class Hash
{
    /**
     * Compare plain text and encrypted text
     *
     * @param string $plain
     * @param string $encrypted
     * @return bool
     */
    public static function check(string $plain, string $encrypted): bool
    {
        return strcmp(self::make($plain), $encrypted) === 0;
    }

    /**
     * Hash string
     *
     * @param string $plain
     * @return string
     */
    public static function make(string $plain): string
    {
        return md5($plain);
    }
}