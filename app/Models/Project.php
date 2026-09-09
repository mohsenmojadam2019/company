<?php

namespace App\Models;

use App\Models\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasSlug;

    protected $fillable = ['title', 'slug', 'category', 'short_description', 'body', 'image', 'client', 'project_url', 'completed_at', 'is_featured', 'is_active', 'sort_order', 'seo_title', 'seo_description'];

    protected function casts(): array
    {
        return ['completed_at' => 'date', 'is_featured' => 'boolean', 'is_active' => 'boolean', 'sort_order' => 'integer'];
    }
}
