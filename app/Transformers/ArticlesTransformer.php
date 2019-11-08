<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticlesTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'tags',
        'category',
    ];
    
    public function transform(Article $model)
    {
        return [
            'id' => $model->id,
            'title' => $model->title,
            'description' => $model->description,
            'view_count' => $model->view_count,
            'slug' => $model->slug,
            'cover_img' => $model->cover_img,
            'sort' => $model->sort,
            'status' => $model->status,
            'comment_status' => $model->comment_status,
            'comment_number' => count($model->commentNumber),
            'publish_at' => $model->publish_at->toDateTimeString(),
            'updated_at' => $model->updated_at->toDateTimeString(),
        ];
    }

    public function includeTags(Article $model)
    {
        $tags = $model->tags;

        return $this->collection($tags, new ArticleTagTransformer());
    }

    public function includeCategory(Article $model)
    {
        $category = $model->category;

        return $this->item($category, new ArticleCategoryTransformer());
    }

}