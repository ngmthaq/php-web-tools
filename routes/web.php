<?php

use App\Http\Controllers\HomeController;
use Core\Route;

return [
    new Route("GET", "/", function () {
        $controller = new HomeController();
        return $controller->index();
    }),

    new Route("GET", "/{0}", function (array $params) {
        $controller = new HomeController();
        return $controller->index2($params[0]);
    }),

    new Route("GET", "/test", function () {
        $controller = new HomeController();
        return $controller->index3();
    }),

    new Route("GET", "/hello", function () {
        $controller = new HomeController();
        return $controller->index4();
    }),
];
