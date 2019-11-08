<?php

namespace App\Models;

class Article extends Model
{
    //
    protected $dates = ['publish_at'];
    protected $guarded = [];


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function commentNumber()
    {
        return $this->hasMany(Comment::class);
    }

}
