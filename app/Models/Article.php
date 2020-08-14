<?php

namespace App\Models;

class Article extends Model
{
    //
    protected $dates = ['publish_at'];
    protected $guarded = [];

    public function getPublishAtAttribute($value)
    {
        return date('Y-m-d H:i', strtotime($value));
    }

    public function getCreatedAtAttribute($value)
    {
        return date('Y-m-d H:i', strtotime($value));
    }

    public function commentNumber()
    {
        return $this->hasMany(Comment::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getIdAttribute($value)
    {
        return hashIdEncode($value);
    }

}
