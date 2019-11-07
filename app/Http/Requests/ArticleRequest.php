<?php

namespace App\Http\Requests;

use App\Rules\CheckCategory;
use App\Rules\CheckTag;
use Illuminate\Validation\Rule;

class ArticleRequest extends Request
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
                    'sort' => ['bail', 'required', 'numeric'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'comment_status' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                    'tags' => ['required', 'string', new CheckTag()]
                ];

            case 'PUT':
                return [
                    'title' => ['bail', 'required', 'string', Rule::unique('articles')->ignore($this->id)],
                    'category_id' => ['bail', 'required', new CheckCategory()],
                    'description' => ['bail', 'required', 'string'],
                    'slug' => ['bail', 'required', 'string', Rule::unique('articles')->ignore($this->id)],
                    'sort' => ['bail', 'required', 'numeric'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'comment_status' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                    'tags' => ['required', 'string', new CheckTag()]
                ];
            case 'PATCH':
                return [
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                ];
        }
    }
}
