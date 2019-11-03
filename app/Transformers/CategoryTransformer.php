<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $model)
    {
        return [
            'id' => $model->id,
            'title' => $model->category_title,
            'articles_count' => $model->articles_count,
            'status' => $model->status == 1 ? '正常' : '禁用',
        ];
    }
}