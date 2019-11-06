<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class TagRequest extends Request
{

    public function rules()
    {
        $route = $this->routeName();
        switch ($route) {
            case 'tag.store':
                return [
                    'title' => ['bail', 'required', 'string', 'unique:tags,tag_title'],
                    'sort' => ['bail', 'required', 'numeric'],
                ];

            case 'tag.save':
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
