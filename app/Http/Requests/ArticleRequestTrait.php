<?php

namespace App\Http\Requests;

use App\Rules\CheckCategory;
use App\Rules\CheckTag;
use Illuminate\Validation\Rule;

trait ArticleRequestTrait
{

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'title' => ['bail', 'required', 'string', 'unique:articles'],
                    'category_id' => ['bail', 'required', new CheckCategory()],
                    'description' => ['bail', 'required', 'string'],
                    'slug' => ['bail', 'required', 'string', 'unique:articles'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                ];

            case 'PUT':
                return [
                    'title' => ['bail', 'required', 'string', Rule::unique('articles')->ignore($this->id)],
                    'category_id' => ['bail', 'required', new CheckCategory()],
                    'description' => ['bail', 'required', 'string'],
                    'slug' => ['bail', 'required', 'string', Rule::unique('articles')->ignore($this->id)],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                ];
            case 'PATCH':
                return [
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                ];
        }
    }
}
