<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFoundException;
use Core\Controller;
use Core\Request;
use Core\Response;
use Exception;
use JetBrains\PhpStorm\NoReturn;

class HomeController extends Controller
{
    /**
     * @return void
     * @throws Exception
     */
    #[NoReturn] public function index(): void
    {
        Response::view("pages.home");
    }

    /**
     * @return void
     * @throws Exception
     */
    #[NoReturn] public function products(): void
    {
        Response::view("pages.products");
    }

    /**
     * @return array
     * @throws NotFoundException
     */
    public function productMiddleware(): array
    {
        $id = Request::param(0);
        if (empty($id)) throw new NotFoundException();
        if (preg_match("/^[0-9]+$/", $id) !== 1) throw new NotFoundException();
        return [$id];
    }

    /**
     * @param int $id
     * @return void
     * @throws Exception
     */
    #[NoReturn] public function product(int $id): void
    {
        Response::view("pages.product", ["id" => $id]);
    }
}
