<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticlesTransformer extends TransformerAbstract
{
    public function transform(Article $model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'description' => $model->description,
            'view_count' => $model->view_count,
            'sort' => $model->sort,
            'status' => $model->status,
            'comment_status' => $model->comment_status,
            'publish_at' => $model->publish_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString(),
        ];
    }
}