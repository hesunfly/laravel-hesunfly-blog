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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
