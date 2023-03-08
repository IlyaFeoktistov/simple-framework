<?php

namespace App\Controllers;

use SF\Routing\Controller;

class ErrorController extends Controller
{
    public function notFound()
    {
        $this->viewData['title'] = '404';
        return $this->view('error/404');
    }
}