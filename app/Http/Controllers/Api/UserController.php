<?php

namespace App\Http\Controllers\Api;

use App\Models\Profile;
use App\Transformers\UserTransformer;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function me()
    {
        $user = Auth::guard('api')->user();

        $userInfo = Profile::where(['user_id' => $user->id])->first();
        $user->profile = $userInfo;

        return $this->response->item($user, new UserTransformer());
    }

    public function profile($id)
    {
        
    }
}
