<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

trait AdRequestTrait
{

    public function rules()
    {
        return [
            'desc' => ['bail', 'required', 'string'],
            'url' => ['bail', 'required', 'string', 'url'],
            'img_path' => ['bail', 'required', 'string'],
            'status' => ['bail', 'required', Rule::in([-1, 1])],
            'sort' => ['bail', 'required', 'numeric'],
        ];
    }
}
