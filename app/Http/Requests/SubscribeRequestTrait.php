<?php

namespace App\Http\Requests;

trait SubscribeRequestTrait
{
    public function rules()
    {
        return [
            'email' => [
                'bail',
                'required',
                'email',
                'unique:subscribes,email'
            ]
        ];
    }

    public function messages()
    {
        return [
            'email.email' => '请输入正确的邮箱地址！',
            'email.unique' => '您已订阅，请勿重复订阅！',
        ];
    }
}
