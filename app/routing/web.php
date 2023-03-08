<?php

namespace App\Routing;

use SF\Facades\Route;

Route::get('/', 'home@index');
Route::get('/about', 'home@about');
Route::get('/test', function($params){
    return $params['param'];
},['param' => 123]);
