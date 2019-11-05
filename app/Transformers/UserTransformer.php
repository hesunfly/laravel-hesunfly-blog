<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public $defaultIncludes = [
        'profile'
    ];

    public function transform(User $model)
    {
        return [
            'id' => $model->id,
            'name' => $model->name,
            'email' => $model->email,
            'phone' => $model->phone,
            'github' => $model->github,
            'login_ip' => $model->login_ip,
            'created_at' => $model->created_at->toDateTimeString(),
        ];
    }

    public function includeProfile(User $model)
    {
        return $this->item($model->profile, new ProfileTransformer());
    }

}