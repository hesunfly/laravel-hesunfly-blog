<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Userinfo;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function me()
    {
        $user = Auth::guard('api')->user();

        $userInfo = Userinfo::where(['user_id' => $user->id])->first();
        $user->profile = $userInfo;

        return $this->response->item($user, new UserTransformer());
    }

    public function profile($id)
    {
        
    }
}
