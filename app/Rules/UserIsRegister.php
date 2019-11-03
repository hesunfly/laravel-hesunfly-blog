<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UserIsRegister implements Rule
{
    public function passes($attribute, $value)
    {
         if (User::where(['email' => $value])->first()) {
             return true;
         }

         return false;
    }

    public function message()
    {
        return '邮箱未注册！';
    }
}
