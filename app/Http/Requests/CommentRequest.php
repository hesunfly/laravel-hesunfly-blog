<?php

namespace App\Http\Requests;

class CommentRequest extends Request
{

    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'article_id' => ['bail', 'required', 'numeric', ''],
                    ''
                ];
        }

    }
}
