<?php

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UserStatus implements Rule
{

    public function passes($attribute, $value)
    {
        $user = User::where(['email' => $value])->first();
        return $user->status == 1;
    }

    public function message()
    {
        return '您不可登录到应用！';
    }
}
