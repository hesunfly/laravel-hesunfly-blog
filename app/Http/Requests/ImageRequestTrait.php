<?php

namespace App\Http\Requests;

trait ImageRequestTrait
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
