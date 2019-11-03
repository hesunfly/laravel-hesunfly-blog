<?php

namespace App\Http\Requests;

use App\Rules\CheckCategory;
use App\Rules\CheckTag;
use Illuminate\Validation\Rule;

class ArticleRequest extends Request
{

    public function rules()
    {
        $route = $this->routeName();
        switch ($route) {
            case 'articles.store':
                return [
                    'title' => ['bail', 'required', 'string', 'unique:articles'],
                    'category_id' => ['bail', 'required', new CheckCategory()],
                    'description' => ['bail', 'required', 'string'],
                    'slug' => ['bail', 'required', 'string', 'unique:articles'],
                    'sort' => ['bail', 'required', 'numeric'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'is_comment' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                    'tags' => ['required', 'string', new CheckTag()]
                ];

            case 'articles.save':
                return [
                    'title' => ['bail', 'required', 'string', Rule::unique('articles')->ignore($this->id)],
                    'category_id' => ['bail', 'required', new CheckCategory()],
                    'description' => ['bail', 'required', 'string'],
                    'slug' => ['bail', 'required', 'string', Rule::unique('articles')->ignore($this->id)],
                    'sort' => ['bail', 'required', 'numeric'],
                    'status' => ['bail', 'required', Rule::in([-1, 1])],
                    'is_comment' => ['bail', 'required', Rule::in([-1, 1])],
                    'content' => ['bail', 'required', 'string'],
                    'tags' => ['required', 'string', new CheckTag()]
                ];

            default:
                return [];
        }
    }
}
