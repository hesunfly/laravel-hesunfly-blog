<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class CheckCommentRequest extends Request
{

    public function rules()
    {
        return [
            'status' => ['bail', 'required', Rule::in([-1, 1])],
        ];
    }
}
