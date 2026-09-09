<?php

namespace App\Support;

use Illuminate\Support\Str;

final class Media
{
    public static function url(?string $path, string $fallback = 'assets/construction/hero-villa.svg'): string
    {
        if (! $path) return asset($fallback);
        if (Str::startsWith($path, ['http://', 'https://'])) return $path;
        if (Str::startsWith($path, ['assets/', 'images/'])) return asset($path);
        return asset('storage/'.$path);
    }
}
