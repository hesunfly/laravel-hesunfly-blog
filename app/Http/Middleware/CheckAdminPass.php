<?php

namespace App\Http\Middleware;

use Closure;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Auth;

class CheckAdminPass
{
    use Helpers;

    //校验用户是否为1号用户，即超级管理员
    public function handle($request, Closure $next)
    {
        if (Auth::guard('api')->id() != 1) {
            $this->response->errorUnauthorized('无权访问');
        }

        return $next($request);
    }
}
