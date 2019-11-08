<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class ArticleCategoryTransformer extends TransformerAbstract
{
    public function transform(Category $model)
    {
        return [
            'id' => $model->id,
            'category_title' => $model->category_title,
        ];
    }
}