<?php

use App\Http\ControllerFactory;
use App\Http\Controllers\HomeController;

return [
    route()->method("GET")->path("/")->action(ControllerFactory::call(HomeController::class, "index")),
    route()->method("GET")->path("/products")->action(ControllerFactory::call(HomeController::class, "products")),
    route()->method("GET")->path("/products/{0}")->action(ControllerFactory::call(HomeController::class, "product2")),
];
