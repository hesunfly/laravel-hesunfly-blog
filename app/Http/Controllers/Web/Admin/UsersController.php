<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\UserRequest;
use App\Services\CacheService;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function edit()
    {
        $user = \Illuminate\Support\Facades\Auth::guard('web')->user();
        return view('admin.user', ['user' => $user]);
    }
    
    public function update(UserRequest $request)
    {
        $requestData = $request->only(['name', 'email', 'password', 'avatar']);

        Auth::guard('web')->user()->update($requestData);

        CacheService::setAvatar($requestData['avatar']);

        return response('success', 200);
    }
}
