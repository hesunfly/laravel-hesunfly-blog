<?php

namespace App\Rules;

use App\Models\Category;
use Illuminate\Contracts\Validation\Rule;

class CheckCategory implements Rule
{

    public function __construct()
    {
        //
    }


    public function passes($attribute, $value)
    {
        if (empty(Category::find($value))) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return '分类不存在！';
    }
}
