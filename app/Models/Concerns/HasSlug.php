<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    protected static function bootHasSlug(): void
    {
        static::saving(function ($model): void {
            if (! $model->slug && $model->title) {
                $base = Str::slug($model->title) ?: Str::random(8);
                $slug = $base;
                $counter = 2;

                while (static::query()
                    ->where('slug', $slug)
                    ->when($model->exists, fn ($query) => $query->where($model->getKeyName(), '!=', $model->getKey()))
                    ->exists()) {
                    $slug = $base.'-'.$counter++;
                }

                $model->slug = $slug;
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
