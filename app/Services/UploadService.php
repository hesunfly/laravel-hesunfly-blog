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
        return array_merge([
            'size' => $image->getClientSize(),
            'disk' => $disk,
            'type' => $type
        ], $res);
    }

    public function file($file)
    {
        $disk = env('FILESYSTEM_DRIVER');

        $res = '';
        switch ($disk) {
            case 'local':
                $res = $this->localDriverUpload($file, 'file', 'file');
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

    private function localDriverUpload($resource, $type, $dir)
    {
        $extension = strtolower($resource->getClientOriginalExtension());
        $filename = $type . '_' . time() . '_' . Str::random(10) . '.' . $extension;
        if ($dir != 'file') {
            $filePath = 'public/' . $dir . '/' . $type;
        } else {
            $filePath = 'public/' . $dir;
        }
        $temp = Storage::disk('local')->putFileAs($filePath, $resource, $filename);
        $path = '/storage' . mb_substr($temp, 6);

        return [
            'path' => $path,
            'name' => $filename
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