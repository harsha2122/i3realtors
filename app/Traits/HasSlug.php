<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::generateUniqueSlug($model->title ?? $model->name ?? '');
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title') || $model->isDirty('name')) {
                if (empty($model->slug) || $model->slug === Str::slug($model->getOriginal('title') ?? $model->getOriginal('name') ?? '')) {
                    $model->slug = static::generateUniqueSlug($model->title ?? $model->name ?? '', $model->id);
                }
            }
        });
    }

    protected static function generateUniqueSlug(string $value, ?int $excludeId = null): string
    {
        $slug = Str::slug($value);
        $originalSlug = $slug;
        $count = 1;

        while (static::slugExists($slug, $excludeId)) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        return $slug;
    }

    protected static function slugExists(string $slug, ?int $excludeId = null): bool
    {
        $query = static::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        return $query->exists();
    }
}
