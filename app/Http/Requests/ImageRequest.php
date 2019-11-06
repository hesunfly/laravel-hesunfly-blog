<?php

namespace App\Http\Requests;

class ImageRequest extends Request
{

    public function rules()
    {
        return [
            'image' => [
                'bail',
                'required',
                'image',
            ]
        ];
    }
}
