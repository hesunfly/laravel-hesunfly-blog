<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Requests\Web\ImageRequest;
use App\Models\Image;
use App\Services\UploadService;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::paginate(20);

        return view('admin.image.index')->with(['images' => $images]);
    }

    public function upload(ImageRequest $request, UploadService $service)
    {
        $image = $request->file('image');
        $saveData = $service->image($image);
        Image::create($saveData);

        return response('success', 200);
    }


    public function destroy($id)
    {
        $image = $this->findOrFail($id, Image::class);
        switch ($image->disk) {
            case 'local':
                unlink(public_path($image->path));
                break;
            case 'qiniu':
                Storage::disk('qiniu')->delete($image->name);
                break;
        }

        $image->delete();
        return response('success', 204);
    }
}
