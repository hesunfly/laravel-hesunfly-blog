<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadService
{

    public function image($image)
    {
        $disk = env('FILESYSTEM_DRIVER');

        $res = '';
        switch ($disk) {
            case 'local':
                $res = $this->localDriverUpload($image, 'image');
                break;
            case 'qiniu':
                $res = $this->qiniuDriverUpload($image);
                break;
        }
        return array_merge([
            'size' => $image->getClientSize(),
            'disk' => $disk,
        ], $res);
    }

    public function file($file)
    {
        $disk = env('FILESYSTEM_DRIVER');

        $res = '';
        switch ($disk) {
            case 'local':
                $res = $this->localDriverUpload($file, 'file');
                break;
            case 'qiniu':
                $res = $this->qiniuDriverUpload($file);
                break;
        }
        return array_merge([
            'size' => $file->getClientSize(),
            'disk' => $disk,
            'file_name' => $file->getClientOriginalName(),
        ], $res);
    }

    private function localDriverUpload($resource, $dir)
    {
        $extension = strtolower($resource->getClientOriginalExtension());
        $filename = 'hesunfly-blog' . '-' . time() . '-' . Str::random(10) . '.' . $extension;
        $filePath = 'public/' . $dir;
        $temp = Storage::disk('local')->putFileAs($filePath, $resource, $filename);
        $path = '/storage' . mb_substr($temp, 6);

        return [
            'path' => $path,
            'name' => $filename,
        ];
    }

    private function qiniuDriverUpload($resource)
    {
        $disk = Storage::disk('qiniu');
        $name = $disk->put('', $resource);
        return [
            'path' => env('QINIU_DOMAIN') . '/' . $name,
            'name' => $name,
        ];
    }
}