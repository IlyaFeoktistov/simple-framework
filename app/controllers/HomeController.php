<?php

namespace App\Controllers;

use SF\Routing\Controller;

class HomeController extends Controller
{
    public function index($params)
    {
        $this->viewData['title'] = 'Главная';
        return $this->view('home/index', $params);
    }

    public function about()
    {
        $this->viewData['title'] = 'Про сайт';
        return $this->view('home/about');
    }
}