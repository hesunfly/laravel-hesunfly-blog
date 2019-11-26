<?php

namespace App\Http\Controllers\Web\Admin;

use App\Models\Image;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();

        return view('admin.image.index')->with(['images' => $images]);
    }
}
