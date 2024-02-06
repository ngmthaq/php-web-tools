<?php

namespace Core;

use eftec\bladeone\BladeOne;

class Response
{
    public static function view(string $name, array $data = [], int $status = 200)
    {
        $views = Dir::resources() . "/views";
        $cache = Dir::cache() . "/views";
        $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);
        $blade->pipeEnable = true;
        http_response_code($status);
        echo $blade->run($name, $data);
    }
}
