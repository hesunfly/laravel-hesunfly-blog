<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\UserRequest;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function edit()
    {
        return view('admin.user');
    }
    
    public function update(UserRequest $request)
    {
        $requestData = $request->only(['name', 'email', 'password']);

        Auth::guard('web')->user()->update($requestData);

        return response('success', 200);
    }
}
