<?php

namespace App\Http\Requests;

Trait RequestTrait
{
    public function authorize()
    {
        return true;
    }
}