<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasSlug;

    protected $fillable = ['title', 'slug', 'eyebrow', 'short_description', 'body', 'icon', 'image', 'sort_order', 'is_active', 'seo_title', 'seo_description'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean', 'sort_order' => 'integer'];
    }
}
