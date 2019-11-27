<?php

namespace App\Transformers;

use App\Models\Ip;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract
{
    public function transform(Ip $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->file_name,
            'path' => $model->disk === 'qiniu' ? $model->path : env('APP_URL') . $model->path,
            'size' => round($model->size / 1024 / 1024, 2) . 'mb',
            'created_at' => $model->created_at->toDateTimeString(),
        ];
    }
}