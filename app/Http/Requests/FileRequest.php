<?php

namespace App\Http\Requests;

class FileRequest extends Request
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
