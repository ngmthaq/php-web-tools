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
        $id = Request::param(0);
        if (empty($id)) throw new NotFoundException();
        if (preg_match("/^[0-9]+$/", $id) !== 1) throw new NotFoundException();
        return [$id];
    }

    public function product(int $id): void
    {
        Response::view("pages.product", ["id" => $id]);
        exit;
    }
}
