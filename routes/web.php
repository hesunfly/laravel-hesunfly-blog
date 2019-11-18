<?php

use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Web',
], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/article/{slug}', 'ArticleController@index');
    Route::get('/achieve', 'IndexController@achieve');

});

Route::group([
    'namespace' => 'Web\Admin',
    'prefix' => 'admin',
], function () {
    Route::get('/login', 'AuthController@showLogin');
    Route::post('/login', 'AuthController@login')->name('auth.login');

    Route::group([
        'middleware' => 'admin.pass',
    ], function () {
        Route::get('/', 'IndexController@index');

    });


});


Horizon::auth(function ($request) {
    return true;
});