<?php

namespace App\Http\Controllers;

use Core\Controller;
use Core\Response;

class HomeController extends Controller
{
    public function index()
    {
        return Response::view("hello");
    }
}
