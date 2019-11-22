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
    Route::post('/login', 'AuthController@login')->name('auth.login');

    Route::get('/email_verify_code/{email}', 'AuthController@emailVerifyCode');
    Route::get('/register', 'AuthController@showRegister');
    Route::post('/register', 'AuthController@register')->name('auth.register');

    Route::delete('/logout', 'AuthController@logout');
});

Route::group([
    'namespace' => 'Web\Admin',
    'prefix' => 'admin',
], function () {
    Route::group([
        'middleware' => 'admin.pass',
    ], function () {
        Route::get('/', 'IndexController@index');

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
        });

        Route::group([
            'prefix' => 'comments',
        ], function () {
            Route::get('/', 'CommentController@index');
        });

        Route::group([
            'prefix' => 'members',
        ], function () {
            Route::get('/', 'MemberController@index');
        });

        Route::group([
            'prefix' => 'images',
        ], function () {
            Route::get('/', 'imageController@index');
        });

        Route::group([
            'prefix' => 'files',
        ], function () {
            Route::get('/', 'FileController@index');
        });

        Route::group([
            'prefix' => 'setting',
        ], function () {
            Route::get('/', 'SettingController@index');
        });
    });

});

Horizon::auth(function ($request) {
    return true;
});