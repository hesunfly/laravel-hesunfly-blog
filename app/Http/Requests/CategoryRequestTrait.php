<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

trait CategoryRequestTrait
{

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => ['bail', 'required', 'string', 'unique:categories,category_title'],
                    'sort' => ['bail', 'sometimes', 'required', 'numeric'],
                ];
            case 'PUT':
                return [
                    'title' => ['bail', 'required', 'string'],
                    'sort' => ['bail', 'sometimes', 'required', 'numeric'],
                    'status' => ['bail', 'sometimes', 'required', Rule::in([-1, 1])],
                ];
        }

    }
}
