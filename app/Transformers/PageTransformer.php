<?php

namespace App\Transformers;

use App\Models\Page;
use League\Fractal\TransformerAbstract;

class PageTransformer extends TransformerAbstract
{
    public function transform(Page $model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'uri' => $model->uri,
            'sort' => $model->sort,
            'content' => $model->content,
            'html_content' => $model->html_content,
            'status' => $model->status == 1 ? '显示' : '不显示',
            'comment_status' => $model->commnet_status == 1 ? '显示' : '不显示',
            'updated_at' => $model->updated_at->toDateTimeString(),
            'publish_at' => $model->publish_at->toDateTimeString(),
        ];
    }
}