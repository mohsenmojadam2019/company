<?php

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;

return [
    'resources' => [
        'services' => [
            'title' => 'Services', 'singular' => 'Service', 'model' => Service::class, 'search' => ['title', 'short_description'],
            'columns' => ['title' => 'Title', 'eyebrow' => 'Label', 'is_active' => 'Active', 'updated_at' => 'Updated'],
            'fields' => [
                'title' => ['label' => 'Title', 'type' => 'text', 'rules' => 'required|string|max:160'],
                'slug' => ['label' => 'Slug', 'type' => 'text', 'rules' => 'nullable|string|max:180|unique:services,slug,{id}'],
                'eyebrow' => ['label' => 'Eyebrow', 'type' => 'text', 'rules' => 'nullable|string|max:80'],
                'short_description' => ['label' => 'Short description', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                'body' => ['label' => 'Full content', 'type' => 'textarea', 'rules' => 'nullable|string'],
                'icon' => ['label' => 'Icon label', 'type' => 'text', 'rules' => 'nullable|string|max:40'],
                'image' => ['label' => 'Image', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
                'is_active' => ['label' => 'Active', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
                'seo_title' => ['label' => 'SEO title', 'type' => 'text', 'rules' => 'nullable|string|max:70'],
                'seo_description' => ['label' => 'SEO description', 'type' => 'textarea', 'rules' => 'nullable|string|max:170'],
            ],
        ],
        'projects' => [
            'title' => 'Projects', 'singular' => 'Project', 'model' => Project::class, 'search' => ['title', 'category', 'client'],
            'columns' => ['title' => 'Title', 'category' => 'Category', 'client' => 'Client', 'is_featured' => 'Featured', 'is_active' => 'Active'],
            'fields' => [
                'title' => ['label' => 'Title', 'type' => 'text', 'rules' => 'required|string|max:160'],
                'slug' => ['label' => 'Slug', 'type' => 'text', 'rules' => 'nullable|string|max:180|unique:projects,slug,{id}'],
                'category' => ['label' => 'Category', 'type' => 'text', 'rules' => 'nullable|string|max:100'],
                'short_description' => ['label' => 'Short description', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                'body' => ['label' => 'Case study', 'type' => 'textarea', 'rules' => 'nullable|string'],
                'image' => ['label' => 'Cover image', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
                'client' => ['label' => 'Client', 'type' => 'text', 'rules' => 'nullable|string|max:120'],
                'project_url' => ['label' => 'Project URL', 'type' => 'url', 'rules' => 'nullable|url|max:255'],
                'completed_at' => ['label' => 'Completed date', 'type' => 'date', 'rules' => 'nullable|date'],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
                'is_featured' => ['label' => 'Featured', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
                'is_active' => ['label' => 'Active', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
                'seo_title' => ['label' => 'SEO title', 'type' => 'text', 'rules' => 'nullable|string|max:70'],
                'seo_description' => ['label' => 'SEO description', 'type' => 'textarea', 'rules' => 'nullable|string|max:170'],
            ],
        ],
        'posts' => [
            'title' => 'Insights', 'singular' => 'Article', 'model' => Post::class, 'search' => ['title', 'excerpt'],
            'columns' => ['title' => 'Title', 'published_at' => 'Published', 'is_active' => 'Active', 'updated_at' => 'Updated'],
            'fields' => [
                'title' => ['label' => 'Title', 'type' => 'text', 'rules' => 'required|string|max:180'],
                'slug' => ['label' => 'Slug', 'type' => 'text', 'rules' => 'nullable|string|max:190|unique:posts,slug,{id}'],
                'excerpt' => ['label' => 'Excerpt', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                'body' => ['label' => 'Article content', 'type' => 'textarea', 'rules' => 'nullable|string'],
                'image' => ['label' => 'Cover image', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
                'published_at' => ['label' => 'Publish date', 'type' => 'datetime-local', 'rules' => 'nullable|date'],
                'is_active' => ['label' => 'Active', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
                'seo_title' => ['label' => 'SEO title', 'type' => 'text', 'rules' => 'nullable|string|max:70'],
                'seo_description' => ['label' => 'SEO description', 'type' => 'textarea', 'rules' => 'nullable|string|max:170'],
            ],
        ],
        'team' => [
            'title' => 'Team', 'singular' => 'Team member', 'model' => TeamMember::class, 'search' => ['name', 'role'],
            'columns' => ['name' => 'Name', 'role' => 'Role', 'is_active' => 'Active', 'updated_at' => 'Updated'],
            'fields' => [
                'name' => ['label' => 'Name', 'type' => 'text', 'rules' => 'required|string|max:120'],
                'role' => ['label' => 'Role', 'type' => 'text', 'rules' => 'nullable|string|max:120'],
                'bio' => ['label' => 'Bio', 'type' => 'textarea', 'rules' => 'nullable|string|max:1000'],
                'image' => ['label' => 'Photo', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
                'linkedin_url' => ['label' => 'LinkedIn URL', 'type' => 'url', 'rules' => 'nullable|url|max:255'],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
                'is_active' => ['label' => 'Active', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
            ],
        ],
        'testimonials' => [
            'title' => 'Testimonials', 'singular' => 'Testimonial', 'model' => Testimonial::class, 'search' => ['name', 'company', 'quote'],
            'columns' => ['name' => 'Name', 'company' => 'Company', 'rating' => 'Rating', 'is_active' => 'Active'],
            'fields' => [
                'name' => ['label' => 'Name', 'type' => 'text', 'rules' => 'required|string|max:120'],
                'company' => ['label' => 'Company', 'type' => 'text', 'rules' => 'nullable|string|max:120'],
                'quote' => ['label' => 'Quote', 'type' => 'textarea', 'rules' => 'required|string|max:1200'],
                'avatar' => ['label' => 'Avatar', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
                'rating' => ['label' => 'Rating', 'type' => 'number', 'rules' => 'nullable|integer|min:1|max:5'],
                'sort_order' => ['label' => 'Sort order', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
                'is_active' => ['label' => 'Active', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
            ],
        ],
    ],
];
