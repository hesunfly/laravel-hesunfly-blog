<?php

namespace App\Http\Requests;


use Dingo\Api\Http\FormRequest;

class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function routeName()
    {
        $routeAction = $this->route()->action;
        return $routeAction['as'];
    }

}