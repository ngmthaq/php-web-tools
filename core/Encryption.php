<?php

namespace Core;

use Exception;

class Encryption
{
    /**
     * Encrypt
     *
     * @param string $plain_text
     * @return string
     */
    public static function encrypt(string $plain_text): string
    {
        $app_configs = require(Dir::configs() . "/app.php");
        $cipher_method = $app_configs["cipher_method"];
        $iv_length = openssl_cipher_iv_length($cipher_method);
        $iv = openssl_random_pseudo_bytes($iv_length);
        $key = $_ENV["APP_HASH_PRIVATE_KEY"];
        $ciphertext_raw = openssl_encrypt($plain_text, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac("sha256", $ciphertext_raw, $key, true);
        return Str::base64UrlEncode($iv . $hmac . $ciphertext_raw);
    }

    /**
     * Decrypt
     *
     * @param $cipher_text
     * @return string
     * @throws Exception
     */
    public static function decrypt($cipher_text): string
    {
        $c = Str::base64UrlDecode($cipher_text);
        $app_configs = require(Dir::configs() . "/app.php");
        $cipher_method = $app_configs["cipher_method"];
        $iv_length = openssl_cipher_iv_length($cipher_method);
        $iv = substr($c, 0, $iv_length);
        $key = $_ENV["APP_HASH_PRIVATE_KEY"];
        $hmac = substr($c, $iv_length, $sha2len = 32);
        $ciphertext_raw = substr($c, $iv_length + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher_method, $key, OPENSSL_RAW_DATA, $iv);
        $calc_mac = hash_hmac("sha256", $ciphertext_raw, $key, true);
        if ($original_plaintext === false) throw new Exception("Failure to decrypt cipher_text", Response::STT_INTERNAL_SERVER_ERROR);
        if (!hash_equals($hmac, $calc_mac)) throw new Exception("Failure to decrypt cipher_text", Response::STT_INTERNAL_SERVER_ERROR);
        return $original_plaintext;

    }
}