<?php

namespace Core;

use Exception;

class Str
{
    /**
     * Get random string
     *
     * @param int $length
     * @return string
     * @throws Exception
     */
    public static function random(int $length = 16): string
    {
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charactersLength = strlen($characters);
        $randomString = "";
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Generate uuid v4
     *
     * @return string
     */
    public static function uuid(): string
    {
        return sprintf("%04x%04x-%04x-%04x-%04x-%04x%04x%04x",
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    /**
     * Base64 URL Encode
     *
     * @param string $data
     * @return string
     */
    public static function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Base64 URL Decode
     *
     * @param string $data
     * @return string
     * @throws Exception
     */
    public static function base64UrlDecode(string $data): string
    {
        $output = base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '='));
        if ($output === false) throw new Exception("Cannot decode base64 url", Response::STT_INTERNAL_SERVER_ERROR);
        return $output;
    }
}