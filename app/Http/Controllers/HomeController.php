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

    public function index2(int $test)
    {
        Debug::consoleLog($test);
        return Response::view("hello");
    }

    public function index3()
    {
        Debug::consoleLog("Test");
        return Response::view("hello");
    }
}
