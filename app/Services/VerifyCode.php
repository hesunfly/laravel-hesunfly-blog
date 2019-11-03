<?php

namespace App\Services;


use App\Mail\VerifyCodeEmail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class VerifyCode
{

    public static function email($email)
    {
        $code = mt_rand(111111, 999999);

        $key = 'email_verify_code_'. $email . '_' .str_random(16);
        $expiredAt = now()->addMinutes(10);
        Cache::put($key, ['email' => $email, 'code' => $code], $expiredAt);

        Mail::to($email)->queue(new VerifyCodeEmail($code));

        return [
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString()
        ];
    }

    public static function checkEmailVerifyCode($key, $email, $code)
    {
        $verifyCodeCache = Cache::pull($key);

        if (empty($verifyCodeCache)) {
            return false;
        }

        if (!(($verifyCodeCache['email'] == $email) && ($verifyCodeCache['code'] == $code))) {
            return false;
        }

        return true;
    }


}