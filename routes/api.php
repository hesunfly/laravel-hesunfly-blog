<?php

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
    'middleware' => [
        'cors',
        ]
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
        'limit' => 100,
        'expires' => 1,
    ], function ($api) {
        //一般请求
        $api->get('articles', 'ArticleController@index');

        $api->get('user/{id}', 'UserController@profile');

        $api->get('bind/github', 'UserController@githubBind');
        $api->get('callback/github', 'UserController@githubCallback');
        //登录后可请求
        $api->group([
//            'middleware' => 'api.auth',
        ], function ($api) {
            $api->get('me', 'UserController@me');
            //管理员可访问
            $api->group([
                /*'middleware' => 'admin.pass',*/
                'namespace' => 'Admin',
                'prefix' => 'admin',
            ], function ($api) {
//
                $api->group([
                    'prefix' => 'tags',
                ], function ($api) {
                    $api->get('', 'TagController@index');
                    $api->get('{id}', 'TagController@show');
                    $api->post('', 'TagController@store');
                    $api->put('{id}', 'TagController@save');
                    $api->delete('{id}', 'TagController@destroy');
                });

                $api->group([
                    'prefix' => 'categories',
                ], function ($api) {
                    $api->get('', 'CategoryController@index');
                    $api->get('{id}', 'CategoryController@show');
                    $api->post('', 'CategoryController@store');
                    $api->put('{id}', 'CategoryController@save');
                    $api->delete('{id}', 'CategoryController@destroy');
                });

                $api->group([
                    'prefix' => 'members',
                ], function ($api) {
                    $api->get('', 'MemberController@index');
                    $api->get('{id}', 'MemberController@show');
                    $api->post('', 'MemberController@store');
                    $api->put('{id}', 'MemberController@update');
                });

                $api->group([
                    'prefix' => 'pages',
                ], function ($api) {
                    $api->get('', 'PageController@index');
                    $api->get('{id}', 'PageController@show');
                    $api->post('', 'PageController@store');
                    $api->put('{id}', 'PageController@save');
                    $api->delete('{id}', 'PageController@destroy');
                });

                $api->group([
                    'prefix' => 'articles',
                ], function ($api) {
                    $api->get('', 'ArticleController@index');
                    $api->get('{id}', 'ArticleController@show');
                    $api->post('', 'ArticleController@store');
                    $api->put('{id}', 'ArticleController@save');
                    $api->delete('{id}', 'ArticleController@destroy');
                    $api->patch('{id}', 'ArticleController@updatePublishStatus');
                });

                $api->group([
                    'prefix' => 'comments',
                ], function ($api) {
                    $api->get('', 'CommentController@index');
                    $api->get('{id}', 'CommentController@show');
                    $api->put('{id}', 'CommentController@update');
                    $api->delete('{id}', 'CommentController@destroy');
                });

                $api->group([
                    'prefix' => 'images',
                ], function ($api) {
                    $api->get('', 'ImageController@index');
                    $api->post('', 'ImageController@store');
                    $api->delete('{id}', 'ImageController@destroy');
                });

                $api->group([
                    'prefix' => 'files',
                ], function ($api) {
                    $api->get('', 'FileController@index');
                    $api->post('', 'FileController@store');
                    $api->delete('{id}', 'FileController@destroy');
                });

                $api->get('dashboard', 'AppController@dashboard');
            });
        });
    });
});
