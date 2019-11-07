<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{

    public function rules()
    {
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
            'password' => [
                'bail',
                'required',
                'string',
                'min:6',
                'max:20',
            ],
        ];
    }
}
