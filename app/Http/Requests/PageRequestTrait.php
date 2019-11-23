<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

trait PageRequestTrait
{
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => ['bail', 'required', 'string', 'unique:pages'],
                    'slug' => ['bail', 'required', 'string', 'unique:pages'],
                    'sort' => ['bail', 'required', 'numeric'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                ];

            case 'PUT':
                return [
                    'title' => ['bail', 'required', 'string', Rule::unique('pages')->ignore($this->id)],
                    'slug' => ['bail', 'required', 'string', Rule::unique('pages')->ignore($this->id)],
                    'sort' => ['bail', 'required', 'numeric'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                ];
        }
    }


}
