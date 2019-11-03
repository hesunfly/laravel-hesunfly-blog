<?php

namespace App\Transformers;

use App\Models\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    public function transform(Tag $model)
    {
        return [
            'id' => $model->id,
            'title' => $model->tag_title,
            'articles_count' => $model->articles_count,
            'status' => $model->status == 1 ? '正常' : '禁用',
        ];
    }
}