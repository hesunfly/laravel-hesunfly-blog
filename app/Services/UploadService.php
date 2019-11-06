<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadService
{

    public function image($image, $type)
    {
        $disk = env('FILESYSTEM_DRIVER');

        $res = '';
        switch ($disk) {
            case 'local':
                $res = $this->localDriverUpload($image, $type, 'image');
                break;
            case 'qiniu':
                $res = $this->qiniuDriverUpload($image, $type);
                break;
        }
        $size = $image->getClientSize();

        return array_merge([
            'size' => $size,
            'disk' => $disk,
            'type' => $type
        ], $res);
    }

    public function file($file)
    {
    }

    private function localDriverUpload($resource, $type, $dir)
    {
        $extension = strtolower($resource->getClientOriginalExtension());
        $filename = $type . '_' . time() . '_' . Str::random(10) . '.' . $extension;
        $temp = Storage::disk('local')->putFileAs('public/' . $dir . '/' . $type, $resource, $filename);
        $path = '/storage' . mb_substr($temp, 6);

        return [
            'path' => $path,
            'name' => $filename
        ];
    }

    private function qiniuDriverUpload($resource, $type)
    {
        $disk = Storage::disk('qiniu');
        $name = $disk->put('', $resource);
        return [
            'path' => env('QINIU_DOMAIN') . '/' . $name,
            'name' => $name,
        ];
    }
}