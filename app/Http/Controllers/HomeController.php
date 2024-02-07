<?php

namespace App\Http\Controllers;

use App\Http\Exceptions\NotFoundException;
use Core\Controller;
use Core\Request;
use Core\Response;

class HomeController extends Controller
{
    public function index(): void
    {
        Response::view("pages.home");
        exit;
    }

    public function products(): void
    {
        Response::view("pages.products");
        exit;
    }

    public function productMiddleware(): array
    {
        $params = Request::resolveParams();
        if (empty($params[0])) throw new NotFoundException();
        if (preg_match("/^[0-9]+$/", $params[0]) !== 1) throw new NotFoundException();
        return [$params[0]];
    }

    public function product(int $id): void
    {
        Response::view("pages.product", ["id" => $id]);
        exit;
    }
}
