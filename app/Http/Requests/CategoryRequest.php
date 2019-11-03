<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CategoryRequest extends Request
{

    public function rules()
    {
        $route = $this->routeName();

        switch ($route) {
            case 'category.store':
                return [
                    'title' => ['bail', 'required', 'string', 'unique:categories,category_title'],
                    'sort' => ['bail', 'required', 'numeric'],
                ];
            case 'category.save':
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
