<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Services\UploadService;
use App\Http\Controllers\Api\Controller;
use App\Transformers\FileTransformer;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function index()
    {
        $files = File::paginate(20);
        return $this->response->paginator($files, new FileTransformer());
    }

    public function store(FileRequest $request, UploadService $service)
    {
        $file = $request->file('file');
        $saveData = $service->file($file);
        File::create($saveData);

        return $this->response->created();
    }

    public function destroy($id)
    {
        $file = $this->findOrFail($id, File::class);
        switch ($file->disk) {
            case 'local':
                unlink(public_path($file->path));
                break;
            case 'qiniu':
                Storage::disk('qiniu')->delete($file->name);
                break;
        }

        $file->delete();
        return $this->response->noContent();
    }
}
