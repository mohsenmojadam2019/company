<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $data = Cache::remember('site.home', now()->addMinutes(10), fn () => [
            'services' => Service::query()->where('is_active', true)->orderBy('sort_order')->limit(6)->get(),
            'projects' => Project::query()->where('is_active', true)->where('is_featured', true)->orderBy('sort_order')->limit(6)->get(),
            'testimonials' => Testimonial::query()->where('is_active', true)->orderBy('sort_order')->limit(6)->get(),
            'posts' => Post::query()->where('is_active', true)->whereNotNull('published_at')->where('published_at', '<=', now())->latest('published_at')->limit(3)->get(),
        ]);

        return view('site.home', $data);
    }

    public function about(): View
    {
        $team = TeamMember::query()->where('is_active', true)->orderBy('sort_order')->get();
        return view('site.about', compact('team'));
    }

    public function services(): View
    {
        $services = Service::query()->where('is_active', true)->orderBy('sort_order')->paginate(12);
        return view('site.services.index', compact('services'));
    }

    public function service(Service $service): View
    {
        abort_unless($service->is_active, 404);
        return view('site.services.show', compact('service'));
    }

    public function projects(Request $request): View
    {
        $query = Project::query()->where('is_active', true);

        if ($search = trim((string) $request->query('q'))) {
            $query->where(fn ($builder) => $builder
                ->where('title', 'like', "%{$search}%")
                ->orWhere('location', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%"));
        }

        if ($category = trim((string) $request->query('category'))) {
            $query->where('category', $category);
        }

        $projects = $query->orderBy('sort_order')->latest()->paginate(12)->withQueryString();
        $categories = Project::query()->where('is_active', true)->whereNotNull('category')->distinct()->orderBy('category')->pluck('category');
        $featured = Project::query()->where('is_active', true)->where('is_featured', true)->orderBy('sort_order')->first();

        return view('site.projects.index', compact('projects', 'categories', 'featured'));
    }

    public function project(Project $project): View
    {
        abort_unless($project->is_active, 404);
        $related = Project::query()->where('is_active', true)->whereKeyNot($project->getKey())->orderBy('sort_order')->limit(3)->get();
        return view('site.projects.show', compact('project', 'related'));
    }

    public function blog(): View
    {
        $posts = Post::query()->where('is_active', true)->whereNotNull('published_at')->where('published_at', '<=', now())->latest('published_at')->paginate(12);
        return view('site.blog.index', compact('posts'));
    }

    public function post(Post $post): View
    {
        abort_unless($post->is_active && $post->published_at?->lte(now()), 404);
        return view('site.blog.show', compact('post'));
    }

    public function contact(): View
    {
        return view('site.contact');
    }
}
