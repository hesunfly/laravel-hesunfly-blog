<?php

namespace App\Transformers;

use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class ArticleCommentNumberTransformer extends TransformerAbstract
{
    public function transform(Comment $model)
    {
        return [
            'count' => $model->comment_count,
        ];
    }
}