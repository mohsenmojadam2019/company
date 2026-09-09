<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasSlug;

    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'image', 'published_at', 'is_active', 'seo_title', 'seo_description'];

    protected function casts(): array
    {
        return ['published_at' => 'datetime', 'is_active' => 'boolean'];
    }
}
