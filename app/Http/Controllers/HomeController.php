<?php

namespace App\Http\Controllers;

use Core\Controller;
use Core\Debug;
use Core\Response;

class HomeController extends Controller
{
    public function index()
    {
        return Response::view("hello");
    }

    public function index2(string $slug)
    {
        return Response::view("hello", ["message" => $slug]);
    }

    public function index3()
    {
        return Response::view("hello", ["message" => "test"]);
    }

    public function index4()
    {
        return Response::view("hello", ["message" => "hello"]);
    }
}
