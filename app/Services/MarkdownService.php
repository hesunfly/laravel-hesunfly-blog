<?php

namespace App\Services;

use Michelf\MarkdownExtra;
use Michelf\SmartyPants;

class MarkdownService
{

    public static function toHtml($content)
    {
        $content = MarkdownExtra::defaultTransform($content);
        $content = SmartyPants::defaultTransform($content);
        return $content;
    }
}