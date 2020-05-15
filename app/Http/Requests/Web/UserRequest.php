<?php

namespace App\Http\Requests\Web;


class UserRequest extends Request
{

    public function rules()
    {
        return [
            'name' => ['bail', 'required', 'string'],
            'email' => ['bail', 'required', 'email'],
//            ''
        ];
    }
}
