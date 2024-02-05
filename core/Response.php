<?php

namespace Core;

use eftec\bladeone\BladeOne;

class Response
{
    public static function view(string $name, array $data = [])
    {
        $views = Dir::resources() . "/views";
        $cache = Dir::resources() . "/cache/views";
        $blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);
        $blade->pipeEnable = true;
        echo $blade->run($name, $data);
    }
}
