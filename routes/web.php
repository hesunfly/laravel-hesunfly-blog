<?php

use Laravel\Horizon\Horizon;

Route::get('/', function () {
    return view('welcome');
});


Horizon::auth(function ($request) {
    return true;
});

//Route::get('/github', '');