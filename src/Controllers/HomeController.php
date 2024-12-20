<?php

namespace App\Controllers;


class HomeController extends Controller
{
    public function index(array $params=null): void
    {

        $router = $this->router;
        $this->view('site/index', compact('router'));
    }

}