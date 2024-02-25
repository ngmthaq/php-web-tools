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

        if ($method === "POST" && in_array($_POST["_method"], $rest_methods)) {
            $_SERVER["REQUEST_METHOD"] = $_POST["_method"];
        }
        
        if (in_array($method, $rest_methods)) {
            parse_str(file_get_contents("php://input"), $_POST);
        }
    }
}