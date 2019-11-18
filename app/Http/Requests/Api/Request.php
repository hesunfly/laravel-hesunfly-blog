<?php

namespace App\Http\Requests\Api;


use App\Http\Requests\RequestTrait;
use Dingo\Api\Http\FormRequest;

class Request extends FormRequest
{
    use RequestTrait;
}