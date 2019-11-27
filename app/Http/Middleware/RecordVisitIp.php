<?php

namespace App\Http\Middleware;

use App\Models\Ip;
use Closure;
use Dingo\Api\Routing\Helpers;

class RecordVisitIp
{
    use Helpers;

    //校验用户是否为1号用户，即超级管理员
    public function handle($request, Closure $next)
    {
        $ip = $request->getClientIp();
        $address = geoip($ip);
        Ip::create(
            [
                'ip' => $ip,
                'address' => $address->country.' - '.$address->state_name.' - '.$address->city,
            ]
        );

        return $next($request);
    }
}