<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function sitemap(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'lastmod' => now()],
            ['loc' => route('about'), 'lastmod' => now()],
            ['loc' => route('services.index'), 'lastmod' => now()],
            ['loc' => route('projects.index'), 'lastmod' => now()],
            ['loc' => route('blog.index'), 'lastmod' => now()],
            ['loc' => route('contact'), 'lastmod' => now()],
        ]);

        Service::query()->where('is_active', true)->get()->each(fn ($item) => $urls->push(['loc' => route('services.show', $item), 'lastmod' => $item->updated_at]));
        Project::query()->where('is_active', true)->get()->each(fn ($item) => $urls->push(['loc' => route('projects.show', $item), 'lastmod' => $item->updated_at]));
        Post::query()->where('is_active', true)->where('published_at', '<=', now())->get()->each(fn ($item) => $urls->push(['loc' => route('blog.show', $item), 'lastmod' => $item->updated_at]));

        return response()->view('site.sitemap', compact('urls'))->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        $body = "User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: ".route('sitemap')."\n";

        return response($body, 200)->header('Content-Type', 'text/plain');
    }
}
