<?php

namespace App\Http\Requests\Web;


class UserRequest extends Request
{

    public function rules()
    {
        return [
            'name' => ['bail', 'required', 'string'],
            'password' =>['bail', 'required', 'min:6', 'string'],
            'email' => ['bail', 'required', 'email'],
//            ''
        ];
    }
}
