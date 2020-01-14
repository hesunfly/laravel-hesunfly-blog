<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Dingo\Api\Routing\Helpers;

class Controller extends BaseController
{
    use Helpers;

   /* protected function userId()
    {
        $this->middleware('api.auth');

        $user = Auth::guard('api')->user();

        return $user->id;
    }

    protected function findOrFail($id, $class)
    {
        try {
            return $class::findOrFail($id);
        } catch (\Exception $exception) {
            $this->response->errorNotFound();
        }
    }*/
}
