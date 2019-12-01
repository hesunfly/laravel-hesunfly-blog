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

        Route::get('/users', 'UsersController@edit');
        Route::put('/users', 'UsersController@update');

        Route::group([
            'prefix' => 'articles',
        ], function () {
            Route::get('/', 'ArticlesController@index');
            Route::get('/write', 'ArticlesController@create');
            Route::post('/store', 'ArticlesController@store');
            Route::get('/edit/{id}', 'ArticlesController@edit');
            Route::put('/save/{id}', 'ArticlesController@save');
            Route::delete('/destroy/{id}', 'ArticlesController@destroy');
        });

        Route::group([
            'prefix' => 'categories',
        ], function () {
            Route::get('/', 'CategoriesController@index');
            Route::get('/create', 'CategoriesController@create');
            Route::post('/store', 'CategoriesController@store');
            Route::get('/edit/{id}', 'CategoriesController@edit');
            Route::put('/save/{id}', 'CategoriesController@save');
            Route::delete('/destroy/{id}', 'CategoriesController@destroy');
        });

        Route::group([
            'prefix' => 'pages',
        ], function () {
            Route::get('/', 'PagesController@index');
            Route::get('/create', 'PagesController@create');
            Route::post('/store', 'PagesController@store');
            Route::get('/edit/{id}', 'PagesController@edit');
            Route::put('/save/{id}', 'PagesController@save');
            Route::delete('/destroy/{id}', 'PagesController@destroy');
        });

        Route::group([
            'prefix' => 'images',
        ], function () {
            Route::get('/', 'ImagesController@index');
            Route::post('/upload', 'ImagesController@upload');
            Route::delete('/destroy/{id}', 'ImagesController@destroy');
        });

        Route::get('ips', 'IndexController@ips');
    });

});

Horizon::auth(function ($request) {
    return true;
});
