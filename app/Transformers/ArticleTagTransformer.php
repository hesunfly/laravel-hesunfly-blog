<?php

namespace App\Transformers;

use App\Models\Tag;
use League\Fractal\TransformerAbstract;

class ArticleTagTransformer extends TransformerAbstract
{
    public function transform(Tag $model)
    {
        return [
            'id' => $model->id,
            'title' => $model->tag_title,
        ];
    }
}