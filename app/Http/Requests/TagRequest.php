<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class TagRequest extends Request
{

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => ['bail', 'required', 'string', 'unique:tags,tag_title'],
                    'sort' => ['bail', 'required', 'numeric'],
                ];

            case 'PUT':
                return [
                    'title' => ['bail', 'required', 'string'],
                    'sort' => ['bail', 'required', 'numeric'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                ];
            default:
                return [];
        }
    }


}
