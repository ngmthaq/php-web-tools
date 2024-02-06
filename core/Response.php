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
        $views = Dir::resources() . "/views";
        $cache = Dir::cache() . "/views";
        $blade = new BladeOne($views, $cache, isProd() ? BladeOne::MODE_AUTO : BladeOne::MODE_DEBUG);
        $blade->pipeEnable = true;
        http_response_code($status);
        echo sanitizeOutput($blade->run($name, $data));
    }
}
