<?php

namespace App\Transformers;

use App\Models\Comment;
use League\Fractal\TransformerAbstract;

class CommentsTransformer extends TransformerAbstract
{
    public function transform(Comment $model)
    {
        return [
            'id' => $model->id,
            'article_id' => $model->article_id,
            'article_title' => $model->article_title,
            'comment_user_id' => $model->comment_user_id,
            'comment_user_name' => $model->comment_user_name,
            'comment_user_email' => $model->comment_user_email,
            'status' => $model->status,
            'ip_address' => $model->ip_address,
            'replay_id' => $model->replay_id,
            'created_at' => $model->created_at->toDateTimeString(),
        ];
    }
}