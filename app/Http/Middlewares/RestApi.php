<?php

namespace App\Http\Middlewares;

use Core\Middleware;
use Core\Server;

class RestApi extends Middleware
{
    public function handle(): void
    {
        $method = Server::resolveMethod();
        $rest_methods = ["PUT", "PATCH", "DELETE"];
        if (in_array($method, $rest_methods)) {
            parse_str(file_get_contents("php://input"), $_POST);
        }
    }
}