<?php

function __(string $string, mixed $args = null)
{
    return L($string, $args);
}


function assets(string $assets_path)
{
    $app_url = $_ENV["APP_PUBLIC_URL"];
    $app_version = $_ENV["APP_VERSION"];
    $app_env = $_ENV["APP_ENV"];
    $time = $app_env !== "production" ?  time() : strtotime("today midnight");
    $app_url = str_ends_with($app_url, "/") ? substr($app_url, 0, -1) : $app_url;
    $assets_path = str_starts_with($assets_path, "/") ?  substr($assets_path, 1) : $assets_path;
    $full_path = "$app_url/$assets_path?v=$app_version&t=$time";
    return $full_path;
}

function sanitizeOutput(string $buffer): string
{
    $app_env = $_ENV["APP_ENV"];
    if ($app_env === "production") {
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
