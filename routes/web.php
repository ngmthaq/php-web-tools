<?php

use App\Http\Controllers\HomeController;
use Core\Route;

return [
    // Homepage
    new Route("GET", "/", function () {
        $controller = new HomeController();
        return $controller->index();
    }),
];
