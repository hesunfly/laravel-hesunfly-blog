<?php

use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Web',
], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/article/{slug}', 'ArticleController@index');
    Route::get('/achieve', 'IndexController@achieve');

    Route::get('/login', 'AuthController@showLogin');
});

Route::group([
    'namespace' => 'Web\Admin',
    'prefix' => 'admin',
], function () {
    Route::get('/', 'IndexController@index');



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