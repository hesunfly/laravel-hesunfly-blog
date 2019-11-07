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
            'slug' => $model->slug,
            'sort' => $model->sort,
            'content' => $model->content,
            'html_content' => $model->html_content,
            'status' => $model->status,
            'comment_status' => $model->comment_status,
            'updated_at' => $model->updated_at->toDateTimeString(),
            'created_at' => $model->created_at->toDateTimeString(),
        ];
    }
}