<?php

use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Web',
    'middleware' => 'ip',
], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/article/{slug}', 'IndexController@article');
    Route::get('/pages/{slug}', 'IndexController@page');

    Route::get('/achieve', 'IndexController@achieve');
});

Route::group([
    'namespace' => 'Web\Admin',
    'prefix' => 'admin',
], function () {
    Route::get('/login', 'AuthController@showLogin');
    Route::post('/login', 'AuthController@login');

    Route::group([
        'middleware' => 'admin.pass',
    ], function () {
        Route::delete('/logout', 'AuthController@logout');

        Route::get('/', 'IndexController@index');

        Route::get('/user', 'UserController@edit');
        Route::put('/user', 'UserController@update');

        Route::group([
            'prefix' => 'articles',
        ], function () {
            Route::get('/', 'ArticleController@index');
            Route::get('/write', 'ArticleController@create');
            Route::post('/store', 'ArticleController@store');
            Route::get('/edit/{id}', 'ArticleController@edit');
            Route::put('/save/{id}', 'ArticleController@save');
            Route::delete('/destroy/{id}', 'ArticleController@destroy');
        });

        Route::group([
            'prefix' => 'categories',
        ], function () {
            Route::get('/', 'CategoryController@index');
            Route::get('/create', 'CategoryController@create');
            Route::post('/store', 'CategoryController@store');
            Route::get('/edit/{id}', 'CategoryController@edit');
            Route::put('/save/{id}', 'CategoryController@save');
            Route::delete('/destroy/{id}', 'CategoryController@destroy');
        });

        Route::group([
            'prefix' => 'pages',
        ], function () {
            Route::get('/', 'PageController@index');
            Route::get('/create', 'PageController@create');
            Route::post('/store', 'PageController@store');
            Route::get('/edit/{id}', 'PageController@edit');
            Route::put('/save/{id}', 'PageController@save');
            Route::delete('/destroy/{id}', 'PageController@destroy');
        });

        Route::group([
            'prefix' => 'images',
        ], function () {
            Route::get('/', 'ImageController@index');
            Route::post('/upload', 'ImageController@upload');
            Route::delete('/destroy/{id}', 'ImageController@destroy');
        });

        Route::get('ips', 'IndexController@ips');
    });

});

Horizon::auth(function ($request) {
    return true;
});
