<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => 'ip',
], function ($api) {
    //请求限流，一分钟10次
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => 10,
        'expires' => 1,
    ], function ($api) {
        $api->post('login', 'AuthController@login')->name('auth.login');
        $api->post('register', 'AuthController@register')->name('auth.register');
        $api->get('refresh', 'AuthController@refresh');

        $api->group(['middleware' => 'api.auth'], function ($api) {
            $api->delete('logout', 'AuthController@logout');
        });

        $api->get('socialite/github', 'AuthController@github');
        $api->get('socialite/callback/github', 'AuthController@githubCallback');
    });

    //请求限流，一分钟1次
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => 1,
        'expires' => 1,
    ], function ($api) {
        $api->get('email-verify-code/{email}', 'AuthController@emailVerifyCode');
    });

    //请求限流，一分钟100次
    $api->group([
        'middleware' => 'api.throttle',
        'limit' => 60,
        'expires' => 1,
    ], function ($api) {
         $api->get('/', 'IndexController@index');

         $api->get('/search/{keyword?}', 'IndexController@index');

         $api->get('/articles/{slug}', 'IndexController@article');

         $api->get('/pages/{slug}', 'IndexController@page');

         $api->get('/achieves', 'IndexController@achieve');

         $api->post('/subscribes', 'IndexController@subscribe');
        });
});
