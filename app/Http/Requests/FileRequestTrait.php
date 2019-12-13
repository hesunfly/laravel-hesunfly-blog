<?php

namespace App\Http\Requests;

trait FileRequestTrait
{

    public function rules()
    {
        return [
            'file' => [
                'bail',
                'required',
                'file'
            ]
        ];
    }
}
