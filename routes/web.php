<?php

use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Horizon::auth(function ($request) {
    return true;
});


Route::get('restore', function () {
    \App\Models\Image::withTrashed()
        ->where('id', 3)
        ->restore();
    \App\Models\Image::withTrashed()
        ->where('id', 4)
        ->restore();
    \App\Models\Image::withTrashed()
        ->where('id', 1)
        ->restore();
});

//Route::get('/github', '');