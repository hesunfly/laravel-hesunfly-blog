<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CategoryRequest extends Request
{

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => ['bail', 'required', 'string', 'unique:categories,category_title'],
                    'sort' => ['bail', 'required', 'numeric'],
                ];
            case 'PUT':
                return [
                    'title' => ['bail', 'required', 'string'],
                    'sort' => ['bail', 'required', 'numeric'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                ];
        }

    }
}
