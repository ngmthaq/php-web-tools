<?php

use App\Http\Middlewares\VerifyCSRF;
use Core\Dir;
use Core\Route;
use Core\Server;

/**
 * Translate
 *
 * @param string $string
 * @param mixed|null $args
 * @return string
 */
function __(string $string, mixed $args = null): string
{
    return L($string, $args);
}

/**
 * Get full assets path
 *
 * @param string $assets_path
 * @return string
 */
function assets(string $assets_path): string
{
    $app_url = $_ENV["APP_PUBLIC_URL"];
    $app_version = $_ENV["APP_VERSION"];
    $time = isProd() ? strtotime("today midnight") : time();
    $app_url = str_ends_with($app_url, "/") ? substr($app_url, 0, -1) : $app_url;
    $assets_path = str_starts_with($assets_path, "/") ? substr($assets_path, 1) : $assets_path;
    return "$app_url/$assets_path?v=$app_version&t=$time";
}

/**
 * Sanitize Output
 *
 * @param string $buffer
 * @return string
 */
function sanitizeOutput(string $buffer): string
{
    if (isProd()) {
        $search = [
            "/\>[^\S ]+/s",
            "/[^\S ]+\</s",
            "/(\s)+/s",
            "/<!--(.|\s)*?-->/",
            "/<pre data-php-debug=\"true\">(.|\s)*?<\/pre>/",
            "/<code data-php-debug=\"true\">(.|\s)*?<\/code>/",
            "/<script data-php-debug=\"true\">(.|\s)*?<\/script>/",
        ];
        $replace = [">", "<", "\\1", "", "", "", ""];
        $buffer = preg_replace($search, $replace, $buffer);
    }
    return $buffer;
}

/**
 * Check prod env
 *
 * @return bool
 */
function isProd(): bool
{
    return file_exists(Dir::root() . "/.prod");
}

/**
 * Init Route
 *
 * @return Route
 */
function route(): Route
{
    return new Route();
}

/**
 * Generate XSRF meta tag
 *
 * @return string
 */
function xsrfMetaTag(): string
{
    $key = VerifyCSRF::SESSION_KEY;
    $xsrf_token = $_SESSION[$key] ?? "";
    return "<meta name=\"$key\" content=\"$xsrf_token\">";
}

/**
 * Generate XSRF input tag and Redirect path
 *
 * @return string
 */
function formHiddenInputTags(): string
{
    $path = Server::resolveFullPath();
    $path_key = Server::PREV_PATH_KEY;
    $key = VerifyCSRF::SESSION_KEY;
    $xsrf_token = $_SESSION[$key] ?? "";
    return implode("\n", [
        "<input type=\"hidden\" name=\"$key\" value=\"$xsrf_token\">",
        "<input type=\"hidden\" name=\"$path_key\" value=\"$path\">",
    ]);
}

/**
 * Get/Set flash message
 *
 * @param string $key
 * @param string|null $message
 * @return string
 */
function flashMessage(string $key, string|null $message = null): string
{
    if (empty($_SESSION["APP-FLASH-MESSAGE"])) $_SESSION["APP-FLASH-MESSAGE"] = [];
    if (empty($message)) {
        $message = $_SESSION["APP-FLASH-MESSAGE"][$key] ?? "";
        unset($_SESSION["APP-FLASH-MESSAGE"][$key]);
    } else {
        $_SESSION["APP-FLASH-MESSAGE"][$key] = $message;
    }
    return $message;
}

/**
 * Get client ip address
 *
 * @return string
 */
function getClientIp(): string
{
    return $_SERVER['HTTP_CLIENT_IP']
        ?? $_SERVER['HTTP_X_FORWARDED_FOR']
        ?? $_SERVER['HTTP_X_FORWARDED']
        ?? $_SERVER['HTTP_FORWARDED_FOR']
        ?? $_SERVER['HTTP_FORWARDED']
        ?? $_SERVER['REMOTE_ADDR']
        ?? 'UNKNOWN';
}
