<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\ImageRequest;
use App\Models\Image;
use App\Services\UploadService;
use App\Http\Controllers\Api\Controller;
use App\Transformers\ImageTransformer;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{

    public function index()
    {
        $images = Image::paginate(20);
        return $this->response->paginator($images, new ImageTransformer());
    }

    public function store(ImageRequest $request, UploadService $service)
    {
        $image = $request->file('image');
        $saveData = $service->image($image, 'normal');
        Image::create($saveData);

        return $this->response->created();
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
        return $this->response->noContent();
    }
}
