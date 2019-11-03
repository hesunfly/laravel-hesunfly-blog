<?php

namespace App\Transformers;

use App\Models\Page;
use League\Fractal\TransformerAbstract;

class PagesTransformer extends TransformerAbstract
{
    public function transform(Page $model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'uri' => $model->uri,
            'sort' => $model->sort,
            'status' => $model->status == 1 ? '显示' : '不显示',
            'comment_status' => $model->commnet_status == 1 ? '显示' : '不显示',
            'updated_at' => $model->updated_at->toDateTimeString(),
        ];
    }
}