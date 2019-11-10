<?php

namespace App\Http\Controllers\Api;


use App\Models\Comment;
use App\Transformers\CommentTransformer;

class CommentController extends Controller
{

    public function show($id)
    {
        $comments = Comment::where(['article_id' => $id, 'status' => 1])->get();

        if (empty($comments)) {
            return $this->response->array(['data' => []]);
        }

        $comments = $this->generateTree($comments->toArray()['data']);

        return $this->response->array(['data' => $comments]);
    }

    public function create()
    {

    }

    private function generateTree($data)
    {
        $temp = [];
        foreach ($data as $item) {
            $temp[$item['id']] = $item;
        }

        $tree = []; //格式化好的树
        foreach ($temp as $item)
            if (isset($temp[$item['replay_id']])) {
                $temp[$item['replay_id']]['replay'][] = &$temp[$item['id']];
            } else {
                $tree[] = &$temp[$item['id']];
            }
        return $tree;
    }
}
