<?php

namespace Core;

use Exception;

class AccessToken
{
    /**
     * Generate AccessToken from user payload
     *
     * @param string $username
     * @param string $encrypted_password
     * @param int $expired // in seconds
     * @return string
     */
    public static function generate(string $username, string $encrypted_password, int $expired = 24 * 60 * 60): string
    {
        $time = time();
        $expired_at = $expired + $time;
        $payload = json_encode(["un" => $username, "ep" => $encrypted_password, "ea" => $expired_at, "ca" => $time]);
        $base64 = Str::base64UrlEncode($payload);
        return Encryption::encrypt($base64);
    }

    /**
     * Get user payload from AccessToken
     *
     * @param string $token
     * @return array
     * @throws Exception
     */
    public static function getPayload(string $token): array
    {
        $base64 = Encryption::decrypt($token);
        $json_payload = Str::base64UrlDecode($base64);
        $payload = json_decode($json_payload, true);
        $is_expired = time() > $payload["ea"];
        $username = $payload["un"];
        $encrypted_password = $payload["ep"];
        $created_at = $payload["ca"];
        $expired_at = $payload["ea"];
        return compact("username", "encrypted_password", "created_at", "expired_at", "is_expired");
    }
}