<?php

namespace App\Transformers;

use App\Models\Profile;
use League\Fractal\TransformerAbstract;

class ProfileTransformer extends TransformerAbstract
{
    public function transform(Profile $model)
    {
        return [
            'user_id' => $model->user_id,
            'gender' => $model->gender,
            'avatar' => $model->avatar,
            'description' => $model->description,
            'homepage' => $model->homepage,
            'real_name' => $model->real_name,
            'qq' => $model->qq,
            'weibo' => $model->weibo,
            'wechat' => $model->wechat,
            'updated_at' => $model->updated_at->toDateTimeString(),
        ];
    }
}
