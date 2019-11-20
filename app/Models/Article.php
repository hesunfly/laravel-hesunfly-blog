<?php

namespace App\Models;

class Article extends Model
{
    //
    protected $dates = ['publish_at'];
    protected $guarded = [];

    public function commentNumber()
    {
        return $this->hasMany(Comment::class);
    }

}
