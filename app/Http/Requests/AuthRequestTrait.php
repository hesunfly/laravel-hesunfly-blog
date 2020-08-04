<?php

namespace App\Http\Requests;

Trait AuthRequestTrait
{
    public function rules()
    {

        return [
            'name' => [
                'bail',
                'required',
            ],
            'password' => [
                'bail',
                'required',
                'string',
                'min:6',
                'max:20',
            ],
        ];
    }

    public function attributes()
    {
        return [
            'email' => '邮箱',
            'password' => '密码',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute不能为空',
            'string' => ':attribute必须为字符类型',
            'email.email' => '邮箱格式不正确',
            'max:20' => ':attributes不能超过20个字符',
            'min:5' => ':attributes不能少于5个字符',
        ];
    }
}
