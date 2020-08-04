<?php

use Laravel\Horizon\Horizon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::group([
    'namespace' => 'Web',
    'middleware' => ['ip', 'cors'],
], function () {
    Route::get('/', 'IndexController@index');
    Route::get('/search/{keyword?}', 'IndexController@index');

    Route::get('/articles/{slug}', 'IndexController@article');

    Route::get('/pages/{slug}', 'IndexController@page');

    Route::get('/achieves', 'IndexController@achieve');

    Route::post('/subscribes', 'IndexController@subscribe');

    Route::get('/subscribes/confirm/{email}/{key}/{code}', 'IndexController@confirm');
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
            Route::get('/edit/{id}', 'ArticlesController@edit')->where('id', '[0-9]+');
            Route::put('/save/{id}', 'ArticlesController@save')->where('id', '[0-9]+');
            Route::delete('/destroy/{id}', 'ArticlesController@destroy')->where('id', '[0-9]+');
            Route::get('/search/{category?}/{keyword?}', 'ArticlesController@index');
        });

        Route::group([
            'prefix' => 'categories',
        ], function () {
            Route::get('/', 'CategoriesController@index');
            Route::get('/create', 'CategoriesController@create');
            Route::post('/store', 'CategoriesController@store');
            Route::get('/edit/{id}', 'CategoriesController@edit')->where('id', '[0-9]+');
            Route::put('/save/{id}', 'CategoriesController@save')->where('id', '[0-9]+');
            Route::delete('/destroy/{id}', 'CategoriesController@destroy')->where('id', '[0-9]+');
        });

        Route::group([
            'prefix' => 'pages',
        ], function () {
            Route::get('/', 'PagesController@index');
            Route::get('/create', 'PagesController@create');
            Route::post('/store', 'PagesController@store');
            Route::get('/edit/{id}', 'PagesController@edit')->where('id', '[0-9]+');
            Route::put('/save/{id}', 'PagesController@save')->where('id', '[0-9]+');
            Route::delete('/destroy/{id}', 'PagesController@destroy')->where('id', '[0-9]+');
        });

        Route::group([
            'prefix' => 'images',
        ], function () {
            Route::get('/', 'ImagesController@index');
            Route::post('/upload', 'ImagesController@upload');
            Route::delete('/destroy/{id}', 'ImagesController@destroy')->where('id', '[0-9]+');
        });

        Route::group([
            'prefix' => 'settings',
        ], function () {
            Route::get('/', 'SettingController@index');
            Route::post('/save', 'SettingController@save');
        });

        Route::group([
            'prefix' => 'ads',
        ], function () {
            Route::get('/', 'AdController@index');
            Route::get('/create', 'AdController@create');
            Route::post('/store', 'AdController@store');
            Route::get('/edit/{id}', 'AdController@edit')->where('id', '[0-9]+');
            Route::put('/save/{id}', 'AdController@save')->where('id', '[0-9]+');
            Route::delete('/destroy/{id}', 'AdController@destroy')->where('id', '[0-9]+');
        });

        Route::get('ips', 'IndexController@ips');

        Route::get('subscribes', 'SubscribesController@index');

    });

});

Horizon::auth(function ($request) {
    if (isset(Auth::guard('web')->user()->id) &&  Auth::guard('web')->user()->id== 1) {
        return true;
    }
    abort(404);
});

Route::get('/init', function () {
    $user = \App\Models\User::first();

    if (!empty($user)) {
        return '已完成初始化！';
    }

    \App\Models\User::create([
        'name' => 'admin',
        'email' => '',
        'password' => '123456',
    ]);

    return '初始化成功';
});

Route::get('/phpinfo', function (){
    phpinfo();
});
