<?php

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\TeamMember;
use App\Models\Testimonial;

return [
    'resources' => [
        'services' => [
            'title' => 'خدمات', 'singular' => 'خدمت', 'model' => Service::class, 'search' => ['title', 'short_description'],
            'columns' => ['title' => 'عنوان', 'eyebrow' => 'برچسب', 'is_active' => 'فعال', 'updated_at' => 'به‌روزرسانی'],
            'fields' => [
                'title' => ['label' => 'عنوان خدمت', 'type' => 'text', 'rules' => 'required|string|max:160'],
                'slug' => ['label' => 'اسلاگ', 'type' => 'text', 'rules' => 'nullable|string|max:180|unique:services,slug,{id}'],
                'eyebrow' => ['label' => 'برچسب کوتاه', 'type' => 'text', 'rules' => 'nullable|string|max:80'],
                'short_description' => ['label' => 'توضیح کوتاه', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                'body' => ['label' => 'توضیحات کامل', 'type' => 'textarea', 'rules' => 'nullable|string'],
                'icon' => ['label' => 'نام آیکن', 'type' => 'text', 'rules' => 'nullable|string|max:40'],
                'image' => ['label' => 'تصویر', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
                'sort_order' => ['label' => 'ترتیب نمایش', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
                'is_active' => ['label' => 'فعال', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
                'seo_title' => ['label' => 'عنوان SEO', 'type' => 'text', 'rules' => 'nullable|string|max:70'],
                'seo_description' => ['label' => 'توضیح SEO', 'type' => 'textarea', 'rules' => 'nullable|string|max:170'],
            ],
        ],
        'projects' => [
            'title' => 'پروژه‌ها', 'singular' => 'پروژه', 'model' => Project::class, 'search' => ['title', 'category', 'client', 'location'],
            'columns' => ['title' => 'عنوان', 'category' => 'دسته‌بندی', 'location' => 'موقعیت', 'status' => 'وضعیت', 'is_featured' => 'ویژه'],
            'fields' => [
                'title' => ['label' => 'عنوان پروژه', 'type' => 'text', 'rules' => 'required|string|max:160'],
                'slug' => ['label' => 'اسلاگ', 'type' => 'text', 'rules' => 'nullable|string|max:180|unique:projects,slug,{id}'],
                'category' => ['label' => 'دسته‌بندی', 'type' => 'text', 'rules' => 'nullable|string|max:100'],
                'short_description' => ['label' => 'توضیح کوتاه', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                'body' => ['label' => 'شرح پروژه', 'type' => 'textarea', 'rules' => 'nullable|string'],
                'image' => ['label' => 'تصویر کاور', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
                'client' => ['label' => 'کارفرما', 'type' => 'text', 'rules' => 'nullable|string|max:120'],
                'location' => ['label' => 'موقعیت پروژه', 'type' => 'text', 'rules' => 'nullable|string|max:160'],
                'status' => ['label' => 'وضعیت پروژه', 'type' => 'text', 'rules' => 'nullable|string|max:60'],
                'units' => ['label' => 'تعداد واحد', 'type' => 'number', 'rules' => 'nullable|integer|min:0|max:5000'],
                'floors' => ['label' => 'تعداد طبقات', 'type' => 'number', 'rules' => 'nullable|integer|min:0|max:500'],
                'area' => ['label' => 'متراژ کل', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
                'year' => ['label' => 'سال', 'type' => 'text', 'rules' => 'nullable|string|max:12'],
                'project_url' => ['label' => 'لینک پروژه', 'type' => 'url', 'rules' => 'nullable|url|max:255'],
                'completed_at' => ['label' => 'تاریخ تکمیل', 'type' => 'date', 'rules' => 'nullable|date'],
                'sort_order' => ['label' => 'ترتیب نمایش', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
                'is_featured' => ['label' => 'پروژه ویژه', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
                'is_active' => ['label' => 'فعال', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
                'seo_title' => ['label' => 'عنوان SEO', 'type' => 'text', 'rules' => 'nullable|string|max:70'],
                'seo_description' => ['label' => 'توضیح SEO', 'type' => 'textarea', 'rules' => 'nullable|string|max:170'],
            ],
        ],
        'posts' => [
            'title' => 'وبلاگ و مقالات', 'singular' => 'مقاله', 'model' => Post::class, 'search' => ['title', 'excerpt'],
            'columns' => ['title' => 'عنوان', 'published_at' => 'انتشار', 'is_active' => 'فعال', 'updated_at' => 'به‌روزرسانی'],
            'fields' => [
                'title' => ['label' => 'عنوان', 'type' => 'text', 'rules' => 'required|string|max:180'],
                'slug' => ['label' => 'اسلاگ', 'type' => 'text', 'rules' => 'nullable|string|max:190|unique:posts,slug,{id}'],
                'excerpt' => ['label' => 'خلاصه', 'type' => 'textarea', 'rules' => 'nullable|string|max:500'],
                'body' => ['label' => 'متن مقاله', 'type' => 'textarea', 'rules' => 'nullable|string'],
                'image' => ['label' => 'تصویر کاور', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
                'published_at' => ['label' => 'تاریخ انتشار', 'type' => 'datetime-local', 'rules' => 'nullable|date'],
                'is_active' => ['label' => 'فعال', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
                'seo_title' => ['label' => 'عنوان SEO', 'type' => 'text', 'rules' => 'nullable|string|max:70'],
                'seo_description' => ['label' => 'توضیح SEO', 'type' => 'textarea', 'rules' => 'nullable|string|max:170'],
            ],
        ],
        'team' => [
            'title' => 'تیم و همکاران', 'singular' => 'عضو تیم', 'model' => TeamMember::class, 'search' => ['name', 'role'],
            'columns' => ['name' => 'نام', 'role' => 'سمت', 'is_active' => 'فعال', 'updated_at' => 'به‌روزرسانی'],
            'fields' => [
                'name' => ['label' => 'نام', 'type' => 'text', 'rules' => 'required|string|max:120'],
                'role' => ['label' => 'سمت', 'type' => 'text', 'rules' => 'nullable|string|max:120'],
                'bio' => ['label' => 'بیوگرافی', 'type' => 'textarea', 'rules' => 'nullable|string|max:1000'],
                'image' => ['label' => 'تصویر', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
                'linkedin_url' => ['label' => 'لینکدین', 'type' => 'url', 'rules' => 'nullable|url|max:255'],
                'sort_order' => ['label' => 'ترتیب', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
                'is_active' => ['label' => 'فعال', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
            ],
        ],
        'testimonials' => [
            'title' => 'نظرات مشتریان', 'singular' => 'نظر مشتری', 'model' => Testimonial::class, 'search' => ['name', 'company', 'quote'],
            'columns' => ['name' => 'نام', 'company' => 'شرکت', 'rating' => 'امتیاز', 'is_active' => 'فعال'],
            'fields' => [
                'name' => ['label' => 'نام', 'type' => 'text', 'rules' => 'required|string|max:120'],
                'company' => ['label' => 'شرکت / سمت', 'type' => 'text', 'rules' => 'nullable|string|max:120'],
                'quote' => ['label' => 'متن نظر', 'type' => 'textarea', 'rules' => 'required|string|max:1200'],
                'avatar' => ['label' => 'آواتار', 'type' => 'image', 'rules' => 'nullable|image|max:4096'],
                'rating' => ['label' => 'امتیاز', 'type' => 'number', 'rules' => 'nullable|integer|min:1|max:5'],
                'sort_order' => ['label' => 'ترتیب', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
                'is_active' => ['label' => 'فعال', 'type' => 'checkbox', 'rules' => 'nullable|boolean'],
            ],
        ],
    ],
];
