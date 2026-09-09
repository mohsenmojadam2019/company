<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = ['name', 'company', 'quote', 'avatar', 'rating', 'sort_order', 'is_active'];

    protected function casts(): array
    {
        return ['rating' => 'integer', 'sort_order' => 'integer', 'is_active' => 'boolean'];
    }
}
