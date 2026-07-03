<?php

namespace App\Actions\Utility;

use Cocur\Slugify\Slugify;
use Illuminate\Support\Str;

class SlugGenerator
{
    public static function generate(string $text, string $modelClass, string $column = 'slug'): string
    {
        $slugify = new Slugify([
            'lowercase' => true,
            'separator' => '-',
        ]);

        // Latin SEO slug
        $latinSlug = $slugify->slugify($text);

        if (! $latinSlug) {
            $latinSlug = Str::random(6);
        }

        // Persian/Arabic readable slug
        $persianSlug = trim($text);

        $persianSlug = preg_replace('/[^\p{Arabic}\p{Persian}\p{L}\p{N}\s]+/u', '', $persianSlug);
        $persianSlug = preg_replace('/\s+/u', '-', $persianSlug);

        $baseSlug = trim("$latinSlug-$persianSlug", '-');

        $slug = $baseSlug;
        $counter = 1;

        while ($modelClass::where($column, $slug)->exists()) {
            $slug = "$baseSlug-$counter";
            $counter++;
        }

        return $slug;
    }
}
