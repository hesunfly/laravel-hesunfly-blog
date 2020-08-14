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
                    'slug' => ['unique:articles'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                    'html_content' => ['bail', 'required', 'string'],
                ];

            case 'PUT':
                $id = hashIdDecode($this->id);
                return [
                    'title' => ['bail', 'required', 'string', Rule::unique('articles')->ignore($id)],
                    'category_id' => ['bail', 'required', new CheckCategory()],
                    'description' => ['bail', 'required', 'string'],
                    'slug' => [Rule::unique('articles')->ignore($id)],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                    'html_content' => ['bail', 'required', 'string'],
                ];
            case 'PATCH':
                return [
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                ];
        }
    }
}
