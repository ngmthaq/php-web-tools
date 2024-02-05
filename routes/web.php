<?php

use App\Http\Controllers\HomeController;
use App\Http\Exceptions\NotFoundException;
use Core\Route;

return [
    new Route("GET", "/", function () {
        $controller = new HomeController();
        return $controller->index();
    }),

    new Route("GET", "/test", function () {
        $controller = new HomeController();
        return $controller->index3();
    }),

    new Route("GET", "/{0}", function (array $params) {
        $controller = new HomeController();
        if (gettype($params[0]) !== "integer") throw new NotFoundException();
        return $controller->index2($params[0]);
    }),
];
