<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class MemberRequest extends Request
{

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
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
            case 'PUT':
                return [
                    'status' => ['bail', 'required', Rule::in([-1, 1])]
                ];
        }

    }
}
