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
            'size' => $model->size,
        ];
    }
}