<?php

use Core\Dir;

/**
 * Translate
 */
function __(string $string, mixed $args = null)
{
    return L($string, $args);
}

/**
 * Get assets path
 */
function assets(string $assets_path)
{
    $app_url = $_ENV["APP_PUBLIC_URL"];
    $app_version = $_ENV["APP_VERSION"];
    $time = isProd() ? strtotime("today midnight") : time();
    $app_url = str_ends_with($app_url, "/") ? substr($app_url, 0, -1) : $app_url;
    $assets_path = str_starts_with($assets_path, "/") ?  substr($assets_path, 1) : $assets_path;
    $full_path = "$app_url/$assets_path?v=$app_version&t=$time";
    return $full_path;
}

/**
 * Sanitize Output
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

function isProd()
{
    return file_exists(Dir::root() . "/.prod");
}
