<?php

namespace App\Http\Requests;

use App\Rules\UserIsRegister;
use App\Rules\UserStatus;

class AuthRequest extends Request
{

    public function rules()
    {
        $route = $this->routeName();
        $password = [
            'bail',
            'required',
            'string',
            'min:6',
            'max:20',
        ];
        switch ($route) {
            case 'auth.login':
                return [
                    'email' => [
                        'bail',
                        'required',
                        'email',
                        new UserIsRegister(),
                        new UserStatus(),
                    ],
                    'password' => $password,
                ];
            case 'auth.register':
                return [
                    'name' => [
                        'bail',
                        'required',
                        'min:5',
                        'max:30',
                        'unique:users',
                    ],
                    'email' => [
                        'bail',
                        'required',
                        'email',
                        'unique:users',
                    ],
                    'password' => $password,
                    'verify_code' => [
                        'bail',
                        'required',
                        'numeric',
                    ],
                    'key' => [
                        'bail',
                        'required',
                        'string',
                    ],
                ];
            case 'member.store':
                return [
                    'name' => [
                        'bail',
                        'required',
                        'min:5',
                        'max:30',
                        'unique:users',
                    ],
                    'email' => [
                        'bail',
                        'required',
                        'email',
                        'unique:users',
                    ],
                    'password' => $password,
                ];
            default:
                return [];
        }

    }

    public function attributes()
    {
        return [
            'name' => '用户名',
            'email' => '邮箱',
            'password' => '密码',
            'verify_code' => '验证码',
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
            'unique:users' => ':attributes已使用',
        ];
    }
}
