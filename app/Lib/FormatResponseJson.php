<?php

namespace App\Lib;

use Dingo\Api\Http\Response\Format\Format;
use Dingo\Api\Http\Response\Format\JsonOptionalFormatting;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Str;

class FormatResponseJson extends Format
{
    use JsonOptionalFormatting;

    public function formatEloquentModel($model)
    {
        $key = Str::singular($model->getTable());

        if (! $model::$snakeAttributes) {
            $key = Str::camel($key);
        }

        return $this->encode([$key => $model->toArray()]);
    }

    public function formatEloquentCollection($collection)
    {
        if ($collection->isEmpty()) {
            return $this->encode([]);
        }

        $model = $collection->first();
        $key = Str::plural($model->getTable());

        if (! $model::$snakeAttributes) {
            $key = Str::camel($key);
        }

        return $this->encode([$key => $collection->toArray()]);
    }

    public function formatArray($content)
    {
        $content = $this->morphToArray($content);

        array_walk_recursive($content, function (&$value) {
            $value = $this->morphToArray($value);
        });

        return $this->encode($content);
    }

    public function getContentType()
    {
        return 'application/json';
    }

    protected function morphToArray($value)
    {
        return $value instanceof Arrayable ? $value->toArray() : $value;
    }

    protected function encode($content)
    {
        $jsonEncodeOptions = [];

        // Here is a place, where any available JSON encoding options, that
        // deal with users' requirements to JSON response formatting and
        // structure, can be conveniently applied to tweak the output.

        if ($this->isJsonPrettyPrintEnabled()) {
            $jsonEncodeOptions[] = JSON_PRETTY_PRINT;
        }

        $formatContent = [
            'data' => $content,
            'code' => 0,
            'msg' => 'success',
        ];

        $encodedString = $this->performJsonEncoding($formatContent, $jsonEncodeOptions);

        if ($this->isCustomIndentStyleRequired()) {
            $encodedString = $this->indentPrettyPrintedJson(
                $encodedString,
                $this->options['indent_style']
            );
        }

        return $encodedString;
    }
}