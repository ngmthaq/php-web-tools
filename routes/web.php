<?php

use App\Http\ControllerFactory;
use App\Http\Controllers\HomeController;

return [
    route()->method("GET")->path("/")->action(ControllerFactory::make(HomeController::class, "index")),
    route()->method("GET")->path("/products")->action(ControllerFactory::make(HomeController::class, "products")),
    route()->method("GET")->path("/products/{0}")->action(ControllerFactory::make(HomeController::class, "product")),
];
