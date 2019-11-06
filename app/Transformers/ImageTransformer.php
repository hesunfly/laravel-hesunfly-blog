<?php

namespace App\Transformers;

use App\Models\Image;
use League\Fractal\TransformerAbstract;

class ImageTransformer extends TransformerAbstract
{
    public function transform(Image $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'path' => $model->disk === 'qiniu' ? $model->path : env('APP_URL') . $model->path,
            'size' => round($model->size / 1024, 2) . 'kb',
            'create_at' => $model->created_at->toDateTimeString(),
        ];
    }
}