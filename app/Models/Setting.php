<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group'];

    public static function put(string $key, mixed $value, string $group = 'general', string $type = 'text'): void
    {
        static::query()->updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group, 'type' => $type]);
    }
}
