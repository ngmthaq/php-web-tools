<?php

namespace Core;

use eftec\bladeone\BladeOne;

class Response
{
    /**
     * Return text/html response
     */
    public static function view(string $name, array $data = [], int $status = 200)
    {
        $app_env = $_ENV["APP_ENV"];
        $views = Dir::resources() . "/views";
        $cache = Dir::cache() . "/views";
        $blade = new BladeOne($views, $cache, $app_env === "production" ? BladeOne::MODE_AUTO : BladeOne::MODE_DEBUG);
        $blade->pipeEnable = true;
        http_response_code($status);
        echo sanitizeOutput($blade->run($name, $data));
    }
}
