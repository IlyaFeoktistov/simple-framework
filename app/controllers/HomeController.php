<?php

namespace App\Controllers;

use SF\Routing\Controller;
use App\Models\User;

class HomeController extends Controller
{
    public function index($params)
    {
        $this->viewData['title'] = 'Главная';

        $user = new User;
        $users = $user->getAll();
        $params['users'] = $users;

        return $this->view('home/index', $params);
    }

    public function about()
    {
        $this->viewData['title'] = 'Про сайт';
        return $this->view('home/about');
    }
}