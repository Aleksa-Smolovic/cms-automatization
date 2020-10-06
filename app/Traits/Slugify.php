<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait Slugify
{

    public static function createSlug($model, $origin, $field, $modelId = null)
    {
        $slug = Str::slug($origin, '-');
        $relatedSlugs = self::getRelatedSlugs($model, $field, $slug, $modelId);
        $relatedSlugsCount = count($relatedSlugs);
        if ($relatedSlugsCount == 0 || !$relatedSlugs->contains($field, $slug))
            return $slug;

        for ($i = 1; $i < $relatedSlugsCount + 1; $i++) {
            $newSlug = $slug . '-' . $i;
            if (!$relatedSlugs->contains($field, $newSlug))
                return $newSlug;
        }
    }

    private static function getRelatedSlugs($model, $field, $slug, $modelId = null)
    {
        $query = $model::query();
        $query->select($field)->where($field, 'like', $slug . '%');
        if (!is_null($modelId))
            $query->where('id', '<>', $modelId);
        return $query->withTrashed()->get();
    }
}
