<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class PageRequest extends Request
{
    public function rules()
    {
        $route = $this->routeName();
        switch ($route) {
            case 'pages.store':
                return [
                    'title' => ['bail', 'required', 'string', 'unique:pages'],
                    'uri' => ['bail', 'required', 'string', 'unique:pages'],
                    'sort' => ['bail', 'required', 'numeric'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'comment_status' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                ];

            case 'pages.save':
                return [
                    'title' => ['bail', 'required', 'string', Rule::unique('pages')->ignore($this->id)],
                    'uri' => ['bail', 'required', 'string', Rule::unique('pages')->ignore($this->id)],
                    'sort' => ['bail', 'required', 'numeric'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'comment_status' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                ];
            default:
                return [];
        }
    }


}
