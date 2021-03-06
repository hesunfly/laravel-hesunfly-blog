<?php

namespace App\Transformers;

use App\Models\Article;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
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
            'slug' => $model->slug,
            'cover_img' => $model->cover_img,
            'view_count' => $model->view_count,
            'content' => $model->content,
            'html_content' => $model->html_content,
            'status' => $model->status,
            'comment_status' => $model->comment_status,
            'publish_at' => empty($model->publish_at) ? '' : $model->publish_at->toDateTimeString(),
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