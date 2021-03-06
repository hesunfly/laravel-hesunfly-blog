<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    protected function findOrFail($id, $class)
    {
        try {
            return $class::findOrFail($id);
        } catch (\Exception $exception) {
            abort(404);
        }
    }
}
