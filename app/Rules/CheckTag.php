<?php

namespace App\Rules;

use App\Models\Tag;
use Illuminate\Contracts\Validation\Rule;

class CheckTag implements Rule
{

    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        $tags = Tag::select('id')->get();
        if (empty($tags)) {
            return false;
        }
        $tag = explode(',', $value);

        $temp = [];
        foreach ($tags as $item) {
            $temp[] = $item->id;
        }

        foreach ($tag as $item) {
            if (!in_array($item, $temp)) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'Tag 不存在！';
    }
}
