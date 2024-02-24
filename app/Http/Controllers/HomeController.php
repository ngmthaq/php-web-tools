<?php

namespace App\Http\Controllers;

use App\Exceptions\FailureValidationException;
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

    /**
     * @return array
     * @throws NotFoundException|FailureValidationException
     */
    public function updateProductMiddleware(): array
    {
        // Check params
        $id = Request::param(0);
        if (empty($id)) throw new NotFoundException();
        if (preg_match("/^[0-9]+$/", $id) !== 1) throw new NotFoundException();

        // Validate form input
        $product_name = Request::input("product_name");
        $error_details = [];
        if (empty($product_name)) $error_details["product_name"] = "This field is required";
        elseif (strlen($product_name) < 3) $error_details["product_name"] = "This field name required min 3 characters";
        if (count($error_details) > 0) throw new FailureValidationException($error_details);

        // Return payload to main function
        return [$id, $product_name];
    }

    /**
     * @param int $id
     * @param string $product_name
     * @return void
     */
    #[NoReturn] public function updateProduct(int $id, string $product_name): void
    {
        exit();
    }
}
