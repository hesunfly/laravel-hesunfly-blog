<?php

namespace App\Http\Requests;

Trait RequestTrait
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